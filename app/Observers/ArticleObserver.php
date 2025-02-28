<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\ArticleRevision;

class ArticleObserver
{
    protected $articleRevision;
    public function __construct(ArticleRevision $articleRevision)
    {
        $this->articleRevision = $articleRevision;
    }


    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
        if (!$article->isDirty()) {
            return;
        }

        ArticleRevision::create([
            'article_id' => $article->id,
            'user_id' => auth()->id(),
            'title' => $article->getOriginal('title'),
            'description' => $article->getOriginal('description'),
            'body' => $article->getOriginal('body'),
            'tags' => $article->tags()->pluck('name')->toArray(),
        ]);
    }
}
