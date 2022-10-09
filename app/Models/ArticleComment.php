<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\User;

class ArticleComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'parent_id',
        'text',
        'likes_counts',
        'dislikes_counts',
    ];

    //User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Article
    public function articles()
    {
        return $this->belongsTo(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(ArticleComment::class, 'parent_id', 'id');
    }

    public function parent_comment()
    {
        return $this->belongsTo(ArticleComment::class, 'parent_id', 'id');
    }
}
