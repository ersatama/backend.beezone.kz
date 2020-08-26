<?php

namespace App\Http\Controllers;

use App\User;
use App\Contracts\UserContract;
use App\Repositories\User_phone\User_phoneRepositoryEloquent;

class UserController extends Controller
{
    protected $userPhone;
    public function __construct(User_phoneRepositoryEloquent $userPhone) {
        $this->userPhone = $userPhone;
    }

    //GET CODE
    public function getCode($phone) {
        return $this->userPhone->getRestoreCodeByPhone($phone);
    }

    //RESTORE PASSWORD
    public function restorePassword($phone) {
        return $this->userPhone->restorePassword($phone);
    }

    //CHECK REFERRAL CODE
    public function referral($token) {
        return User::where(UserContract::TOKEN,$token)->first();
    }

    //SET USER STATUS BLOCKED
    public function block($id) {
        User::where(UserContract::ID, $id)->update([
            UserContract::DEL => UserContract::DEL_BLOCKED
        ]);
    }

    //SET USER STATUS ACTIVE
    public function active($id) {
        User::where(UserContract::ID, $id)->update([
            UserContract::DEL => UserContract::DEL_ACTIVE
        ]);
    }

    //SET USER STATUS DELETED
    public function delete($id) {
        User::where(UserContract::ID, $id)->update([
            UserContract::DEL => UserContract::DEL_DELETED
        ]);
    }

}
