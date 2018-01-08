<?php
namespace App\Controller;
use App\Model\CoreObject;
use App\Model\Page;
use App\Model\Router;
use App\Model\Request;

abstract class ControllerAbstract extends CoreObject
{
    protected $page;
    protected $router;
    protected $request;

    public function __construct(Router $router, Request $request)
    {
        $this->router = $router;
        $this->page = new Page();
        $this->page->addGlobal('router', $router);
        $this->request = $request;
    }

    public function execute($method)
    {
        if (!is_callable([$this, $method]))
        {
            throw new \RuntimeException('L\'action "'.$method.'" n\'est pas définie sur ce module');
        }
        //$this->preDispatch($method);

        return $this->$method();

        //$this->postDispatch($method);
    }

    protected function preDispatch($action)
    {
        return $this;
    }

    protected function postDispatch($action)
    {
        return $this;
    }

    public function getControllerName()
    {
        return str_replace('App\Controller\Controller', '',static::class);
    }

    public function getRouter()
    {
        return $this->router;
    }
}