<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\ArticleComment;


class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'likes_counts',
        'dislikes_counts',
        'comments_counts',
    ];

    //User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Article
    public function articleComments()
    {
        return $this->hasMany(ArticleComment::class);
    }

    //LikeDiclike
    public function articleOpinion()
    {
        return $this->hasMany(ArticleOpinion::class);
    }

    //ArticleFavorite
    public function articleFavorite()
    {
        return $this->hasMany(ArticleFavorite::class);
    }
}
