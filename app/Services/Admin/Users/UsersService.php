<?php

namespace App\Services\Admin\Users;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\ArticleFavorite;
use App\Models\ArticleOpinion;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersService
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

    //Admin User Add
    public function signup($registredData)
    {
        $userData = $this->userModel::create([
            'name' => $registredData['name'],
            'email' => $registredData['email'],
            'age' => $registredData['age'],
            'password' => bcrypt($registredData['password']),
            'type' => $registredData['type'],
        ]);

        if ($userData) {
            return true;
        }
        return false;
    }

    public function makeAdmin($id)
    {
        $user = $this->userModel::where(['id' => $id])->first();

        $deleteInUser = $this->userModel::where(['id' => $id])->update(['type' => 'admin', 'updated_at' => $user->updated_at]);

        if ($deleteInUser) {
            return $user;
        }
        return false;
    }

    public function makeRegular($id)
    {
        $user = $this->userModel::where(['id' => $id])->first();

        $deleteInUser = $this->userModel::where(['id' => $id])->update(['type' => 'regular', 'updated_at' => $user->updated_at]);

        if ($deleteInUser) {
            return $user;
        }
        return false;
    }

    //User Delete
    public function userDestroy($id)
    {
        $user = $this->userModel::where(['id' => $id])->first();

        $deleteInUser = $this->userModel::find($id)->delete();

        if ($deleteInUser) {
            return $user;
        }
        return false;
    }

    public function usersDataChange($id)
    {
        $user = $this->userModel::with(['articles', 'article_comments', 'articleOpinion', 'articleFavorite'])->where(['id' => $id])->first(['id', 'type', 'name', 'age', 'email', 'avatar',  'created_at']);

        if (!empty($user)) {
            return  $user;
        }
        return false;
    }
}
