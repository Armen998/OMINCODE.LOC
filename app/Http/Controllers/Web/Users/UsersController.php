<?php

namespace App\Http\Controllers\Web\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDataUpdateFormRequest;
use App\Http\Requests\UserPasswordUpdateFormRequest;
use App\Services\Web\Users\UsersService;

class UsersController extends Controller
{
    protected $service;

    public function __construct(UsersService $service)
    {
        $this->service = $service;
    }

    //Profile User
    public function index()
    {
        $data = $this->service->index();

        return view('users.user', ['articles' => $data['articles']]);
    }

    public function articles()
    {
        $data = $this->service->articles();

        return view('users.articles',  ['articles' => $data['articles']]);
    }

    //Updete Data User
    public function update(UserDataUpdateFormRequest $request)
    {
        $updatedData = $request->validated();

        $updated = $this->service->update($updatedData);

        if ($updated ) {
            return redirect()->back()->with(['changed' => 'your information has been changed.']);
        }
        return redirect()->back()->with(['notChange' => 'Your data has not changed.']);
    }

    //Updete User Password
    public function passwordUpdate(UserPasswordUpdateFormRequest $request)
    {
        $updatedPasswordData = $request->validated();

        $updated = $this->service->passwordUpdate($updatedPasswordData);

        if ($updated) {
            return redirect()->back()->with(['passwordChanged' => 'your information has been changed.']);
        } else {
            return redirect()->back()->with(['passwordnotChange' => 'Your data has not changed.']);
        }
    }
}
