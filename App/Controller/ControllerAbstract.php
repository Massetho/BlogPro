<?php
/**
 * @description: Abstract class for Controllers
 * @author: Quentin Thomasset
 * @package: BlogPro
 */
namespace App\Controller;

use App\Model\CoreObject;
use App\Model\Page;
use App\Model\Router;
use App\Model\Request;
use App\Model\Response;
use App\Model\Entity\Admin;

abstract class ControllerAbstract extends CoreObject
{
    protected $page;
    protected $router;
    protected $request;
    protected $vars;

    /**
     * ControllerAbstract constructor.
     * @param Router $router
     * @param Request $request
     * @param array $vars
     */
    public function __construct(Router $router, Request $request, $vars = [])
    {
        $this->router = $router;
        $this->page = new Page();
        $this->request = $request;
        $this->vars = $vars;
    }

    public function checkAdmin()
    {
        $auth = Admin::isAuthenticated();
        if (Admin::isAuthenticated() >= _USER_ADMIN_) {
            return true;
        }
        return false;
    }


    /**
     * @param $method
     * @return mixed
     */
    public function execute($method)
    {
        if (!is_callable([$this, $method])) {
            throw new \RuntimeException('L\'action "'.$method.'" n\'est pas définie sur ce module');
        }

        return $this->$method();
    }

    //Special CSRF security
    public function authFormVerify()
    {
        if ($this->request->postExists('authForm') && ($this->request->postData('authForm') === $this->request->sessionData('authForm'))) {
            return true;
        } else {
            return false;
        }
    }

    public function getControllerName()
    {
        return str_replace('App\Controller\Controller', '', static::class);
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function writeLogs($message)
    {
        $urlFolder = _HOME_DIR__ . '../../logs/';
        $filename = date("Y-m-d_H-i-s");

        if ($message != "") {
            $fp = fopen($urlFolder . $filename . '.' . 'csv', 'w');
            fwrite($fp, $message);
            fclose($fp);
        }
    }

}
