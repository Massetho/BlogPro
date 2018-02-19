<?php
namespace App\Model;

class Response
{
    protected $body;

    public function __construct()
    {
    }

    public function addHeader($header)
    {
        header($header);
    }

    public function redirect($location)
    {
        header('Location: ' . $location);
        exit;
    }

    public function redirect404()
    {
        Err404::getMsg();
    }

    public function setBody($content) {
        if ($content != '')
        {
            $this->body =$content;
        }
        return $this;
    }

    public function send()
    {
       echo $this->body;
       exit;
    }

    public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
}