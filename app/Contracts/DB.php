<?php


namespace App\Contracts;


interface DB
{
    public const ID = 'id';

    //DEFAULT VALUES
    public const REF_DEFAULT        = 0;
    public const DEL_DELETED        = 'deleted';
    public const DEL_ACTIVE         = 'active';
    public const DEL_BLOCKED        = 'blocked';
    public const DEL_VALUES         = [
        self::DEL_DELETED,
        self::DEL_ACTIVE,
        self::DEL_BLOCKED
    ];
}
