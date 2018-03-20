<?php
/**
 * @description :
 * @package : PhpStorm.
 * @Author : quent
 * @date: 15/03/2018
 * @time: 16:01
 */

namespace App\Model;

class Err500
{
    protected static $message = "<h1>500 Error.</h1><p>Internal server error.</p>";

    public static function getMsg()
    {
        echo self::$message;
    }
}