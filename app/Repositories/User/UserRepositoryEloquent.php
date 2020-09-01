<?php


namespace App\Repositories\User;

use App\Contracts\StatusCode;
use App\Contracts\UserContract;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepositoryEloquent implements UserRepositoryInterface
{

    public function register(array $data) {
        $token = uniqid();
        return User::create([
            UserContract::TOKEN     => $token,
            UserContract::PHONE     => $data['phone'],
            UserContract::REF       => $data['ref'],
            UserContract::PASSWORD  => Hash::make($data['password']),
        ]);
    }

    public function dealerInfo($id) {
        return User::where([
            [UserContract::ID,$id],
            [UserContract::DEL,UserContract::DEL_ACTIVE]
        ])->first();
    }

    public function dealers() {

        /*$phone          = '87784139424';
        $password       = 'qwerty00';
        $credentials    = [
            UserContract::PHONE    => $phone,
            UserContract::PASSWORD => $password,
        ];
        if (Auth::attempt($credentials)) {
            return response(Auth::id(), StatusCode::OK);//IF AUTH SUCCESS, THEN RETURN OK
        }*/
        if (Auth::check()) {
            return User::where([
                [UserContract::REF,Auth::id()],
                [UserContract::DEL,UserContract::DEL_ACTIVE]
            ])->count();
        }
        return response('UNAUTHORIZED', StatusCode::UNAUTHORIZED);
    }

    public function subDealers() {
        if (Auth::check()) {
            $subDealers = 0;
            $dealers = User::where([
                [UserContract::REF,Auth::id()],
                [UserContract::DEL,UserContract::DEL_ACTIVE]
            ])->get();
            foreach ($dealers as $key=>$value) {
                $subDealers += User::where([
                    [UserContract::REF,$value[UserContract::ID]],
                    [UserContract::DEL,UserContract::DEL_ACTIVE]
                ])->count();
            }
            return $subDealers;
        }
        return response('UNAUTHORIZED', StatusCode::UNAUTHORIZED);
    }

}
