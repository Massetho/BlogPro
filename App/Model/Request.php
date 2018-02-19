<?php
namespace App\Model;

class Request
{
    public function cookieData($key)
    {
        return isset($_COOKIE[$key]) ? htmlspecialchars($_COOKIE[$key]) : null;
    }

    public function cookieExists($key)
    {
        return isset($_COOKIE[$key]);
    }

    public function getData($key)
    {
        return isset($_GET[$key]) ? htmlspecialchars($_GET[$key]) : null;
    }

    public function getExists($key)
    {
        return isset($_GET[$key]);
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function postData($key)
    {
        return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : null;
    }

    public function postExists($key)
    {
        return isset($_POST[$key]);
    }

    public function fileName($key)
    {
        return isset($_FILES[$key]) ? htmlspecialchars($_FILES[$key]['name']) : null;
    }

    public function requestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }
}