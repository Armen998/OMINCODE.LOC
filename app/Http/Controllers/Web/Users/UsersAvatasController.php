<?php

namespace App\Http\Controllers\Web\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarFormRequest;
use App\Models\User;
use App\Services\Web\Users\AvatarsService;

class UsersAvatasController extends Controller
{
    protected $service;
    
    protected $userModel;

    public function __construct(AvatarsService $service, User $userModel)
    {
        $this->service = $service;

        $this->userModel = $userModel;
    }

    //Add Avatar
    public function add()
    {
        return view('users.add');
    }

    public function create(AvatarFormRequest $request)
    {
        $createdData = $request->validated();

        $update = $this->service->create($createdData);

        if ($update) {
            return redirect()->route('users');
        }
        return redirect()->back();
    }

    //Delete Avatar
    public function destroy()
    {
        $user = $this->userModel::find(auth('web')->id());

        $delete = $this->service->destroy($user);
        if ($delete) {
            return redirect()->route('users');
        }
        return redirect()->back();
    }
}
