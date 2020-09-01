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

    //DEALERS COUNT
    public function dealers() {
        return $this->user->dealers();
    }

    //SUB DEALERS COUNT
    public function subDealers() {
        return $this->user->subDealers();
    }

    //DEALER INFO BY ID
    public function dealerInfo($id) {
        return $this->user->dealerInfo($id);
    }

    //VERIFY CODE
    public function verifyCode(Request $request) {
        $phone  = $request->input('phone');
        $user   = User::where(UserContract::PHONE,$phone)->first();
        if ($user) {
            $user->phone_verified_at = date('Y-m-d G:i:s');
            $user->save();
            return response($user, StatusCode::OK);
        }
        return response('UNAUTHORIZED', StatusCode::BAD_REQUEST);
    }

    //SAVE USER INFO
    public function store(Request $request) {

        $id                 = $request->input('id');
        $name               = $request->input('name');
        $surname            = $request->input('surname');
        $last_name          = $request->input('last_name');
        $phone_verified_at  = $request->input('phone_verified_at');
        $email              = $request->input('email');
        $email_verified_at  = $request->input('email_verified_at');
        $email_notification = $request->input('email_notification');
        $push_notification  = $request->input('push_notification');

        $user                       = User::where(UserContract::ID,$id)->first();
        $user->name                 = $name;
        $user->surname              = $surname;
        $user->last_name            = $last_name;
        $user->phone_verified_at    = $phone_verified_at;
        $user->email                = $email;
        $user->email_verified_at    = $email_verified_at;
        $user->email_notification   = $email_notification;
        $user->push_notification    = $push_notification;
        $user->save();

        return $request->all();
    }

    //GET USER INFO
    public function get() {
        if (Auth::check()) {
            $user = User::where(UserContract::ID,Auth::id())->first();
            return response($user, StatusCode::OK);
        }
        return response('UNAUTHORIZED', StatusCode::UNAUTHORIZED);
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
