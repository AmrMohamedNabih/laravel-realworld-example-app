<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleRevisionResource;
use App\Models\Article;
use App\Models\ArticleRevision;
use Illuminate\Http\Request;

class ArticleRevisionController extends Controller
{
    public function index(Article $article)
    {
        $this->authorize('viewRevisions', $article);

        return ArticleRevisionResource::collection($article->revisions()->get());
    }

    public function show(Article $article, ArticleRevision $revision)
    {
        $this->authorize('viewRevisions', $article);

        return new ArticleRevisionResource($revision);
    }

    public function revert(Article $article, ArticleRevision $revision)
    {
        $this->authorize('revert', $article);

        $article->update([
            'title' => $revision->title,
            'description' => $revision->description,
            'body' => $revision->body,
        ]);

        $article->tags()->sync(
            array_map(
                fn($tag) => $article->tags()->firstOrCreate(['name' => $tag])->id,
                $revision->tags ?? []
            )
        );

        return response()->json([
            'message' => 'Article reverted successfully',
            'article' => new ArticleResource($article)
        ]);
    }
}
