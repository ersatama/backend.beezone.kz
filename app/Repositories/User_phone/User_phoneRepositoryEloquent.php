<?php


namespace App\Repositories\User_phone;

use App\Contracts\StatusCode;
use App\Contracts\UserContract;
use App\User;
use App\Models\user_phone;
use App\Models\user_phone_restore;
use App\Contracts\UserPhone;
use App\Contracts\UserPhoneRestore;

class User_phoneRepositoryEloquent implements User_phoneRepositoryInterface
{

    private $start    = 100000;//RANDOM CODE START
    private $end      = 999999;//RANDOM CODE END

    const LOGIN    = 'emart';//LOGIN
    const PASSWORD = 'qwerty00';//PASSWORD
    const COMPANY  = 'beezone';//BEEZONE
    const URL      = 'https://smsc.kz/sys/send.php?login=';//URL

    public function restorePassword(String $phone) {
        $user = User::where(UserContract::PHONE,$phone)->first();
        if ($user) {
            $code = $this->setNewRestoreCode($user->id,$phone);//SET NEW CODE
            return response($code, StatusCode::OK);
        }
        return response('NOT FOUND', StatusCode::NOT_FOUND);
    }

    public function setRegisterCode(int $user_id, string $phone):int {
        $code = mt_rand($this->start,$this->end);//RANDOM CODE
        $userPhone = $this->getCodeByPhone($phone);//GET CODE BY PHONE
        if ($userPhone) {
            $this->updateCode($phone,$code);
        } else {
            $this->storeCode($user_id,$phone,$code);
        }
        $this->sms($code,$phone);
        return $code;
    }

    public function setNewRestoreCode(int $user_id, string $phone):int {
        $code = mt_rand($this->start,$this->end);//RANDOM CODE
        $userPhoneRestore = $this->getRestoreCodeByPhone($phone);//GET CODE BY PHONE
        if ($userPhoneRestore) {//IF CODE EXISTS
            $this->update($phone,$code);//UPDATE CODE
        } else {
            $this->store($user_id,$phone,$code);//STORE NEW CODE
        }
        $this->sms($code,$phone);
        return $code;
    }

    public function getCodeByPhone(string $phone) {
        return user_phone::where(
            UserPhone::PHONE,
            $phone
        )->first();
    }

    public function getRestoreCodeByPhone(string $phone) {
        return user_phone_restore::where(
            UserPhoneRestore::PHONE,
            $phone
        )->first();
    }

    public function updateCode(string $phone, int $code):void {
        user_phone::where(UserPhone::PHONE,$phone)->update([
            UserPhone::CODE => $code,
            UserPhone::DEL  => UserPhone::DEL_ACTIVE
        ]);
    }

    public function update(string $phone, int $code):void {
        user_phone_restore::where(UserPhoneRestore::PHONE,$phone)->update([
            UserPhoneRestore::CODE  => $code,
            UserPhoneRestore::DEL   => UserPhoneRestore::DEL_ACTIVE
        ]);
    }

    public function storeCode(int $user_id, string $phone, int $code):void {
        $userPhone          = new user_phone;
        $userPhone->user_id = $user_id;
        $userPhone->phone   = $phone;
        $userPhone->code    = $code;
        $userPhone->del     = UserPhone::DEL_ACTIVE;
        $userPhone->save();
    }

    public function store(int $user_id, string $phone, int $code):void {
        $userPhoneRestore           = new user_phone_restore;
        $userPhoneRestore->user_id  = $user_id;
        $userPhoneRestore->phone    = $phone;
        $userPhoneRestore->code     = $code;
        $userPhoneRestore->del      = UserPhoneRestore::DEL_ACTIVE;
        $userPhoneRestore->save();
    }

    public function sms(int $code, string $phone):void {
        $phone   = str_replace('','-',$phone);
        $message = join('',['Ваш SMS код: ',$code]);
        $ch      = curl_init();
        curl_setopt($ch, CURLOPT_URL, join('',[
            self::URL,
            self::LOGIN,
            '&psw=',
            self::PASSWORD,
            '&phones=',
            $phone,
            '&sender=',
            self::COMPANY,
            '&mes=',
            $message
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
    }
}
