<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 17/11/2017
 * Time: 16:11
 */
namespace App\Block;

use App\Model\CoreObject;

abstract class BlockAbstract extends CoreObject
{
    protected $controller;
    protected $collection = [];
    protected $view; //path to template
    protected $entity;
    protected $block = 'content'; //name of the variable where the block will show

    public function __construct($controller, $entity = NULL)
    {
        if ($controller)
        {
            $this->controller = $controller;
        }
        if ($entity !== NULL)
        {
            $this->entity = $entity;
        }
    }

    public function getTemplate()
    {
        return $this->view;
    }

    public function getBlock()
    {
        return $this->block;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function addVar($varName, $var)
    {
        $this->$varName = $var;
    }

    public function render()
    {
        ob_start();
        require_once($this->getTemplate());
        return ob_get_clean();
    }
}