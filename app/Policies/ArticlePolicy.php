<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /**
     * Determine if the user can view revisions of an article.
     */
    public function viewRevisions(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    /**
     * Determine if the user can revert an article to a previous revision.
     */
    public function revert(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }
}
