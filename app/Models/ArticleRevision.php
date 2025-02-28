<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleRevision extends Model
{
    use HasFactory;
    protected $fillable = ['article_id', 'user_id', 'title', 'description', 'body', 'tags'];

    protected $casts = [
        'tags' => 'array',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
