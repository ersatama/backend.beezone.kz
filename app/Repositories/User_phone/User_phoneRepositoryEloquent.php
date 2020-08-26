<?php


namespace App\Repositories\User_phone;

use App\Contracts\StatusCode;
use App\User;
use App\Models\user_phone;
use App\Models\user_phone_restore;
use App\Contracts\UserPhoneRestore;

class User_phoneRepositoryEloquent implements User_phoneRepositoryInterface
{
    private $start  = 100000;//RANDOM CODE START
    private $end    = 999999;//RANDOM CODE END

    public function restorePassword(String $phone) {
        $user = User::where('phone',$phone)->first();
        if ($user) {
            $code = $this->setNewRestoreCode($user->id,$phone);//SET NEW CODE
            return response($code, StatusCode::OK);
        }
        return response('NOT FOUND', StatusCode::NOT_FOUND);
    }

    public function setNewRestoreCode(int $user_id, string $phone):int {
        $code = mt_rand($this->start,$this->end);//RANDOM CODE
        $userPhoneRestore = $this->getRestoreCodeByPhone($phone);//GET CODE BY PHONE
        if ($userPhoneRestore) {//IF CODE EXISTS
            $this->update($phone,$code);//UPDATE CODE
        } else {
            $this->store($user_id,$phone,$code);//STORE NEW CODE
        }
        return $code;
    }

    public function getRestoreCodeByPhone(string $phone) {
        return user_phone_restore::where(
            UserPhoneRestore::PHONE,
            $phone
        )->first();
    }

    public function update(string $phone, int $code):void {
        user_phone_restore::where(UserPhoneRestore::PHONE,$phone)->update([
            UserPhoneRestore::CODE  => $code,
            UserPhoneRestore::DEL   => UserPhoneRestore::DEL_ACTIVE
        ]);
    }

    public function store(int $user_id, string $phone, int $code):void {
        $userPhoneRestore           = new user_phone_restore;
        $userPhoneRestore->user_id  = $user_id;
        $userPhoneRestore->phone    = $phone;
        $userPhoneRestore->code     = $code;
        $userPhoneRestore->del      = UserPhoneRestore::DEL_ACTIVE;
        $userPhoneRestore->save();
    }
}
