<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginFormRequest;
use App\Http\Requests\AvatarFormRequest;
use App\Http\Requests\UserDataUpdateFormRequest;
use App\Http\Requests\UserPasswordUpdateFormRequest;
use App\Services\Admin\Auth\AuthService;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    //Login
    public function login()
    {
        return view('admin.login');
    }

    public function signin(AdminLoginFormRequest $request)
    {
        $createdData = $request->validated();

        if ($this->service->signin($createdData)) {
            return redirect()->route('admin.home');
        }
        return redirect()->back()->with(['suspension' => 'Incorrect email or password']);
    }

    //Admin Home
    public function index()
    {
        $data = $this->service->index();

        return view('admin.index', ['articles' => $data['articles'], 'regularUsers' => $data['regularUsers'], 'adminUsers' => $data['adminUsers']]);
    }

    //Admin Profile
    public function adminProfile()
    {

        $data = $this->service->index();

        return view('admin.admin-profile', ['articles' => $data['articles'],  'regularUsers' => $data['regularUsers'], 'adminUsers' => $data['adminUsers']]);
    }


    public function adminDataUpdate(UserDataUpdateFormRequest $request)
    {
        $updatedData = $request->validated();

        $updated = $this->service->adminDataUpdate($updatedData);

        if ($updated) {
            return redirect()->back()->with(['changed' => 'your information has been changed.']);
        }
        return redirect()->back()->with(['notChange' => 'Your data has not changed.']);
    }

    public function adminPasswordUpdate(UserPasswordUpdateFormRequest $request)
    {
        $updatedPasswordData = $request->validated();

        $updated = $this->service->adminPasswordUpdate($updatedPasswordData);

        if ($updated) {
            return redirect()->back()->with(['passwordChanged' => 'your information has been changed.']);
        }
        return redirect()->back()->with(['passwordnotChange' => 'Your data has not changed.']);
    }

    //Add Avatar
    public function avatarAdd()
    {
        $data = $this->service->addAvatar();

        return view('admin.avatar-add', ['user' => $data['user']]);
    }

    //Avatar Create
    public function avatarCreate(AvatarFormRequest $request)
    {
        $createdData = $request->validated();

        $update = $this->service->createAvatar($createdData);

        if ($update) {
            return redirect()->route('admin.home');
        }
        return redirect()->back();
    }

    //Delete Avatar
    public function avatarDestroy()
    {
        $delete = $this->service->avatarDestroy();
        if ($delete) {
            return redirect()->route('users');
        }
        return redirect()->back();
    }

    //Logout
    public function logout()
    {
        $this->service->logout();

        return redirect()->route('admin.login');
    }
}
