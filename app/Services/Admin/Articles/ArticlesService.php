<?php

namespace App\Services\Admin\Articles;

use App\Models\Article;
use App\Models\ArticleOpinion;
use App\Models\ArticleComment;
use App\Models\ArticleFavorite;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ArticlesService
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

    public function index()
    {
        $articles = $this->articleModel::with([
            'user', 'articleComments', 'articleOpinion',
            'articleFavorite' => function ($query) {
                $query->where(['user_id' => auth('admin')->id()]);
            }
        ])->get();

        $adminUsers = $this->userModel::with(['articles', 'article_comments', 'articleOpinion', 'articleFavorite'])->where(['type' => 'admin'])->get(['id', 'type', 'name', 'age', 'email', 'avatar',  'created_at']);

        $regularUsers = $this->userModel::with(['articles', 'article_comments', 'articleOpinion', 'articleFavorite'])->where(['type' => 'regular'])->get(['id', 'type', 'name', 'age', 'email', 'avatar',  'created_at']);

        return [
            'articles' => $articles,
            'regularUsers' => $regularUsers,
            'adminUsers' => $adminUsers,
        ];
    }
    
     // Article block
     public function articleBlock($id)
     {
         $article = $this->articleModel::with(['user'])->where(['id' => $id])->first();
 
         $presentTyme = date('Y-m-d h:i:s', time());
 
         $articles_block = $this->articleModel::where(['id' => $id])->update(['block_time' => $presentTyme, 'updated_at' => $article->updated_at]);
 
         if ($articles_block) {
             return  $article;
         }
         return false;
     }
 
     // Article Unlock
     public function articleUnlock($id)
     {
         $article = $this->articleModel::with(['user'])->where(['id' => $id])->first();
 
         $articles_block = $this->articleModel::where(['id' => $id])->update(['block_time' => Null, 'updated_at' => $article->updated_at]);
 
         if ($articles_block) {
             return  $article;
         }
         return false;
     }
 
     //Article Favorite
     public function articleFavorite($id)
     {
         $article = $this->articleModel::with(['user'])->where(['id' => $id])->first();
 
         $articlefavorite =  $this->articleFavoriteModel::where(['user_id' => auth('admin')->id(), 'article_id' => $id])->first();
 
         if (empty($articlefavorite)) {
             $this->articleFavoriteModel::create([
                 'user_id' => auth('admin')->id(),
                 'article_id' => $id,
             ]);
             return  $article;
         }
         return false;
     }
 
     //Article Unfavotite
     public function articlesUnfavorite($id)
     {
         $id = (int) $id;
         $article = $this->articleModel::with(['user'])->where(['id' => $id])->first();
 
         $article_favorite = $this->articleFavoriteModel::where(['user_id' => auth('admin')->id(), 'article_id' => $id])->delete();
 
         if ($article_favorite) {
             return $article;
         }
         return false;
     }
 
     //Article Delete
     public function articleDestroy($id)
     {
         $article = $this->articleModel::with(['user'])->where(['id' => $id])->first();
 
         $deleteInArticle = $this->articleModel::find($id)->delete();
 
         if ($deleteInArticle) {
             return $article;
         }
         return false;
     }
}
