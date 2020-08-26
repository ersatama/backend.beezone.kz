<?php

namespace App\Http\Controllers;

use App\User;
use App\Contracts\UserContract;

class UserController extends Controller
{

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
