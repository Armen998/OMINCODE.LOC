<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\User;

class ArticleOpinion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'is_like',
        'is_dislike',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function articles()
    {
        return $this->belongsTo(Article::class);
    }
}
