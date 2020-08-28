<?php

namespace App\Http\Controllers;

use App\Contracts\StatusCode;
use App\User;
use App\Contracts\UserContract;
use App\Repositories\User_phone\User_phoneRepositoryEloquent;
use App\Repositories\User\UserRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userPhone;
    protected $user;
    public function __construct() {
        $this->userPhone = new User_phoneRepositoryEloquent;
        $this->user      = new UserRepositoryEloquent;
    }

    public function register(Request $request) {
        $user = $this->user->register($request->all());
        return $this->userPhone->setRegisterCode($user->id, $user->phone);
    }

    //GET USER INFO
    public function getInfo() {
        if (Auth::check()) {
            $user = User::where('id',Auth::id())->first();
            return response($user, StatusCode::OK);
        } else {
            return response('UNAUTHORIZED', StatusCode::UNAUTHORIZED);
        }
    }

    //CHANGE PASSWORD
    public function changePassword($phone,$password) {
        $user = User::where(UserContract::PHONE,$phone)->first();
        if ($user) {
            $user->password = Hash::make($password);
            $user->save();
            return response(Auth::id(), StatusCode::OK);
        }
        return response(Auth::id(), StatusCode::BAD_REQUEST);
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
