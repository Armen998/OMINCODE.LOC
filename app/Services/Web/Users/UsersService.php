<?php

namespace App\Services\Web\Users;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    protected $userModel;

    protected $articleModel;

    public function __construct(User $userModel, Article $articleModel)
    {
        $this->userModel = $userModel;

        $this->articleModel = $articleModel;
    }

    public function index()
    {
        $articles = $this->articleModel::where(['user_id' => auth('web')->id()])->get(['id', 'user_id', 'title', 'description', 'status',  'created_at', 'updated_at']);

        return [
            'articles' => $articles,
        ];
    }

    public function articles()
    {
        $articles = $this->articleModel::where(['user_id' => auth('web')->id()])->get(['id', 'user_id', 'title', 'description', 'status', 'created_at', 'updated_at']);

        return [
            'articles' => $articles,
        ];
    }

    public function update($updatedData)
    {
        $userData = $this->userModel::where(['id' => auth('web')->id()])->first(['name', 'age', 'email']);

        $checkEmail = $this->userModel::where(['email' => $updatedData['email']])->first(['email']);

        if (!empty([$userData, $updatedData]) && empty($checkEmail) || $checkEmail->email === auth('web')->user()->email) {
            $this->userModel::find(auth('web')->id())->update($updatedData);
            return true;
        }
        return false;
    }

    public function passwordUpdate($updatedPasswordData)
    {
        if (Hash::check($updatedPasswordData['current_password'], auth('web')->user()->password)) {
            if ($updatedPasswordData['new_password'] === $updatedPasswordData['confirm_new_password']) {
                $this->userModel::where(['id' => auth('web')->id()])->update(['password' => bcrypt($updatedPasswordData['new_password'])]);
                return true;
            }
        }
        return false;
    }

}
