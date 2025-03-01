<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ArticleRevision;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleRevisionTest extends TestCase
{
    use RefreshDatabase;
    public function test_revision_is_created()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id,
            'title' => 'create title 1',
            'body' => 'create  Body 1',
            'description' => 'create  description 1',
        ]);

        $this->actingAs($user)->put("/api/articles/{$article->slug}", [
            'article' => [
                "title" => "Updated Title 1",
                'body' => 'Updated Body 1',
                'description' => 'Updated description 1',
                'tagList' => ['Updated tagList 1'],
            ]
        ]);
        $this->assertDatabaseHas('article_revisions', [
            'article_id' => $article->id,
            'title' => 'create title 1',
            'body' => 'create  Body 1',
            'description' => 'create  description 1',
        ]);
    }
    
}
