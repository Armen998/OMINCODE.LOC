<?php

namespace App\Services;

use App\Models\Article;
use App\Models\ArticleOpinion;
use App\Models\ArticleComment;
use App\Models\ArticleFavorite;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminService
{
    protected $userModel;

    protected $articleModel;

    protected $articleCommentModel;

    protected $articleOpinionModel;

    protected $articleFavoriteModel;

    public function __construct(User $userModel, Article $articleModel, ArticleComment $articleCommentModel, ArticleOpinion $articleOpinionModel, ArticleFavorite $articleFavoriteModel)
    {
        $this->userModel = $userModel;

        $this->articleModel = $articleModel;

        $this->articleOpinionModel = $articleOpinionModel;

        $this->articleCommentModel = $articleCommentModel;

        $this->articleFavoriteModel = $articleFavoriteModel;
    }


    

    public function logout()
    {
        auth('admin')->logout();
    }
}
