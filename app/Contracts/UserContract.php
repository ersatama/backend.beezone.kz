<?php


namespace App\Contracts;


class UserContract implements DB
{

    //TABLE NAME
    public const TABLE              = 'users';

    //FIELD NAMES
    public const STATUS             = 'status';
    public const NAME               = 'name';
    public const SURNAME            = 'surname';
    public const LAST_NAME          = 'last_name';
    public const PHONE              = 'phone';
    public const PHONE_VERIFIED_AT  = 'phone_verified_at';
    public const EMAIL              = 'email';
    public const EMAIL_VERIFIED_AT  = 'email_verified_at';
    public const ADDRESS            = 'address';
    public const TOKEN              = 'token';
    public const REF                = 'ref';
    public const DEL                = 'del';
    public const PASSWORD           = 'password';
    public const EMAIL_NOTIFICATION = 'email_notification';
    public const PUSH_NOTIFICATION  = 'push_notification';
    Public const REMEMBER_TOKEN     = 'remember_token';

    //DEFAULT VALUES
    public const EMAIL_NOTIFICATION_DEFAULT = 0;
    public const PUSH_NOTIFICATION_DEFAULT  = 0;

}
