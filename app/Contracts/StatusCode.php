<?php


namespace App\Contracts;


class StatusCode
{
    const STATUS                        = 'status';
    const OK                            = 200;
    const BAD_REQUEST                   = 400;
    const UNAUTHORIZED                  = 401;
    const PAYMENT_REQUIRED              = 402;
    const FORBIDDEN                     = 403;
    const NOT_FOUND                     = 404;
    const METHOD_NOT_ALLOWED            = 405;
    const NOT_ACCEPTABLE                = 406;
    const PROXY_AUTHENTICATION_REQUIRED = 407;
    const REQUEST_TIMEOUT               = 408;
    const CONFLICT                      = 409;
    const GONE                          = 410;
    const LENGTH_REQUIRED               = 411;
    const PRECONDITION_FAILED           = 412;
    const PAYLOAD_TOO_LARGE             = 413;
    const URI_TOO_LONG                  = 414;
    const UNSUPPORTED_MEDIA_TYPE        = 415;
    const RANGE_NOT_SATISFIABLE         = 416;
    const EXPECTATION_FAILED            = 417;
    const I_M_A_TEAPOT                  = 418;
    const AUTHENTICATION_TIMEOUT        = 419;
    const MISDIRECTED_REQUEST           = 421;
    const UNPROCESSABLE_ENTITY          = 422;
    const LOCKED                        = 423;
    const FAILED_DEPENDENCY             = 424;
    const TOO_EARLY                     = 425;
    const UPGRADE_REQUIRED              = 426;
}
