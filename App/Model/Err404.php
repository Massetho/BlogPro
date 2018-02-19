<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 23/10/2017
 * Time: 16:47
 */

namespace App\Model;

class Err404
{
    protected static $message = "<h1>404 Error.</h1><p>Page Not Found</p>";

    public static function getMsg()
    {
        echo self::$message;
    }
}