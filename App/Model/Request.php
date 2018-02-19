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

    public function postData($key, $filter = NULL)
    {
        if ($filter === NULL)
        {
            return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : null;
        }
        else
        {
            return filter_input(INPUT_POST, $key, $filter);
        }
    }

    public function postExists($key)
    {
        return isset($_POST[$key]);
    }

    public function sessionExists($key)
    {
        return isset($_SESSION[$key]);
    }

    public function sessionData($key)
    {
        return isset($_SESSION[$key]) ? htmlspecialchars($_SESSION[$key]) : null;
    }
    public function sessionSet($key = NULL, $value = NULL)
    {
        if ($key && $value)
            $_SESSION[$key] = $value;
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