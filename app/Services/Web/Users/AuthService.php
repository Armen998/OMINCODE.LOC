<?php

namespace App\Services\Web\Users;

use App\Models\Article;
use App\Models\User;


class AuthService
{
    protected $userModel;

    protected $articleModel;

    public function __construct(User $userModel, Article $articleModel)
    {
        $this->userModel = $userModel;

        $this->articleModel = $articleModel;
    }

    public function signup($registredData)
    {
        $userData = $this->userModel::create([
            'name' => $registredData['name'],
            'type' => 'regular',
            'email' => $registredData['email'],
            'age' => $registredData['age'],
            'password' => bcrypt($registredData['password'])
        ]);

        if ($userData) {
            return true;
        }
        return false;
    }

    public function signin($authedData)
    {
        if (auth('web')->attempt($authedData)) {
            return true;
        }
        return false;
    }

    public function index()
    {
        $articles = $this->articleModel::with([
            'user', 'articleComments',
            'articleOpinion' => function ($query) {
                $query->where(['user_id' => auth('web')->id()]);
            }
        ])->get();

        return [
            'articles' => $articles,
        ];
    }

    public function logout()
    {
        auth('web')->logout();
    }
}
