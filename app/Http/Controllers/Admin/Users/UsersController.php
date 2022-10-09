<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginFormRequest;
use App\Http\Requests\AdminRegistrationFormRequest;
use App\Services\Admin\Users\UsersService;



class UsersController extends Controller
{
    protected $service;

    public function __construct(UsersService $service)
    {
        $this->service = $service;
    }

    public function users()
    {
        $data = $this->service->index();

        return view('admin.user', ['articles' => $data['articles'],  'regularUsers' => $data['regularUsers'], 'adminUsers' => $data['adminUsers']]);
    }

    public function userAdd()
    {
        $data = $this->service->index();

        return view('admin.user-add', ['articles' => $data['articles'], 'regularUsers' => $data['regularUsers'], 'adminUsers' => $data['adminUsers']]);
    }
    
    //Admin User Add
    public function signup(AdminRegistrationFormRequest $request)
    {
        $registredData = $request->validated();
        $userData = $this->service->signup($registredData);

        if ($userData) {
            $tmp = $registredData['name'] . '\'s ' . ' ' . ' \'\'' . $registredData['email'] . '\'\'' . ' user has been ' . ' \'\'' . ' ' . $registredData['type'] . ' \'\'';
            return redirect()->route('admin.user-add')->with(['userRegistred' => $tmp]);
        }
        $tmp = $registredData['name'] . '\'s ' . ' ' . ' \'\'' . $registredData['email'] . '\'\'' . ' user Not Add';
        return redirect()->back()->with(['userNotRegistred' => $tmp]);
    }

    //Make Admin
    public function makeAdmin($id)
    {
        $makeAdmin = $this->service->makeAdmin($id);

        if (!empty($makeAdmin)) {
            $tmp = $makeAdmin->name . '\'s ' . ' ' . ' \'\'' . $makeAdmin->email . '\'\'' . ' user make Admin.';
            return redirect('admin/users')->with(['make_admin' => $tmp]);
        }
        return redirect()->back();
    }

    //Make Regular
    public function makeRegular($id)
    {
        $makeRegular = $this->service->makeRegular($id);

        if (!empty($makeRegular)) {
            $tmp = $makeRegular->name . '\'s ' . ' ' . ' \'\'' . $makeRegular->email . '\'\'' . ' user mak Regular.';
            return redirect('admin/users')->with(['make_regular' => $tmp]);
        }
        return redirect()->back();
    }

    //User Delete
    public function userDestroy($id)
    {
        $delete = $this->service->userDestroy($id);

        if (!empty($delete)) {
            $tmp = $delete->name . '\'s ' . ' ' . ' \'\'' . $delete->email . '\'\'' . ' user has been deleted.';
            return redirect('admin/users')->with(['user_deleted' => $tmp]);
        }
        return redirect()->back();
    }

    public function usersDataChange($id)
    {
        $data = $this->service->usersDataChange($id);

        if ($data) {
            return view('Admin.user-data-change', ['user' => $data['user']]);
        }
        return redirect()->back();
    }

    public function usersHome($id)
    {
        $data = $this->service->usersDataChange($id);

        if ($data) {
            return view('Admin.user-home', ['user' => $data['user']]);
        }
        return redirect()->back();
    }
}
