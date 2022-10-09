<?php

namespace App\Services\Web\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AvatarsService
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function create($createdData)
    {
        $avatarPath = $createdData['avatar']->store('avatars', 'public');

        $user = $this->userModel::find(auth('web')->id());

        if ($this->userModel::where([ 'id' => auth('web')->id()])->update([ 'avatar' => $avatarPath, 'updated_at' => $user->updated_at])) {
            return true;
        } else {
            return false;
        }
    }

    public function destroy($user)
    {
        $user = $this->userModel::find(auth('web')->id());
        
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
}
