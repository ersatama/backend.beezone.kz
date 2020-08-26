<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Contracts\UserContract;
use App\Contracts\StatusCode;
use App\Repositories\User_phone;

class LoginController extends Controller
{
    protected $userPhone;
    public function __construct(User_phone $userPhone)
    {
        $this->$userPhone = $userPhone;
    }

    public function auth(Request $request) {
        $phone          = $request->input('phone');
        $password       = $request->input('password');
        $credentials    = [
            UserContract::PHONE    => $phone,
            UserContract::PASSWORD => $password
        ];
        if (Auth::attempt($credentials)) {
            //$user = User::where('');
            return response(Auth::id(), StatusCode::OK);//IF AUTH SUCCESS, THEN RETURN OK
        }
        return response('', StatusCode::UNAUTHORIZED);//UNAUTHORIZED
    }

    public function getByPhone(Request $request) {

        $phone  = $request->get('phone');//USER PHONE
        $user   = User::where(UserContract::PHONE,$phone)->first();//GET USER BY PHONE

        if ($user) {
            return response($user, StatusCode::OK);//IF USER EXISTS RETURN OK
        }

        //IF USER DOESN'T EXIST RETURN NOT REGISTERED
        return response([StatusCode::STATUS => 'not registered'], StatusCode::NOT_FOUND);
    }

    public function show()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = $request->validate([
            'email'     => 'required',
            'password'  => 'required|min:6'
        ]);

        if (Auth::attempt($validator)) {
            return redirect()->route('dashboard');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return back();
    }

}
