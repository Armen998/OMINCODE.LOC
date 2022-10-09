<?php

namespace App\Services\Admin\Auth;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\ArticleFavorite;
use App\Models\ArticleOpinion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthService
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

    //Admin Login
    public function signin($createdData)
    {
        $adminData = $this->userModel::where(['email' => $createdData['email']])->first();

        if (!empty($adminData) && $adminData->type === 'admin' && auth('admin')->attempt($createdData)) {
            return true;
        }
        return false;
    }

    //Admin Home
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

    public function adminDataUpdate($updatedData)
    {
        $userData = $this->userModel::where(['id' => auth('admin')->id()])->first(['name', 'age', 'email']);

        $checkEmail = $this->userModel::where(['email' => $updatedData['email']])->first(['email']);

        if (!empty([$userData, $updatedData]) && empty($checkEmail) || $checkEmail->email === auth('admin')->user()->email) {
            $this->userModel::find(auth('admin')->id())->update($updatedData);
            return true;
        }
        return false;
    }

    public function adminPasswordUpdate($updatedPasswordData)
    {
        if (Hash::check($updatedPasswordData['current_password'], auth('web')->user()->password)) {
            if ($updatedPasswordData['new_password'] === $updatedPasswordData['confirm_new_password']) {
                $this->userModel::where(['id' => auth('web')->id()])->update(['password' => bcrypt($updatedPasswordData['new_password'])]);
                return true;
            }
        }
        return false;
    }

    //Avatar Add
    public function addAvatar()
    {
        $user = $this->userModel::with(['articles' => function ($query) {
            $query->where(['user_id' => auth('web')->id()]);
        }])->where(['id' => auth('web')->id()])->get(['id', 'name', 'age', 'email',]);

        return [
            'user' => $user,
        ];
    }

    //Avatar create
    public function createAvatar($createdData)
    {
        $avatarPath = $createdData['avatar']->store('avatars', 'public');

        $user = $this->userModel::find(auth('admin')->id());

        $user->avatar = $avatarPath;

        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }

    //Avatar Delete
    public function avatarDestroy()
    {
        $user = $this->userModel::find(auth('admin')->id());

        DB::transaction(function () use ($user) {
            $deleteInStorage = Storage::disk('public')->delete($user->avatar);

            $user->avatar = Null;

            if ($user->update() && $deleteInStorage) {
                DB::commit();
                return true;
            }
        }, 3);
        return false;
    }
    
    public function logout()
    {
        auth('admin')->logout();
    }
}
