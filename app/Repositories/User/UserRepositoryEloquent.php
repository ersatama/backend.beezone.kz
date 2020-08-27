<?php


namespace App\Repositories\User;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepositoryEloquent implements UserRepositoryInterface
{
    public function register(array $data) {
        $token = strtoupper(uniqid());
        return User::create([
            'token' => $token,
            'phone' => $data['phone'],
            'ref'   => $data['ref'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
