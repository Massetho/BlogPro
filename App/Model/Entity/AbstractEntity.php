<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 25/10/2017
 * Time: 16:38
 */

namespace App\Model\Entity;

use App\Model\Manager;

abstract class AbstractEntity
{
    protected $data = [];
    protected $manager;
    protected $vars =[];

    public function __construct($data = NULL)
    {
        if ($data)
        {
            $this->data = $data;
        }
        $this->getManager();
    }

    public function getManager()
    {
        $managerName = str_replace('Entity', 'Manager', static::class);
        $managerName =  $managerName . 'Manager';
        $this->manager = new $managerName;
    }

    public function __call($methodName, $arguments)
    {
        // TODO: Implement __call() method.
        $substr = substr($methodName, 0, 3);
        if ($substr === "set")
        {
            $column = lcfirst(str_replace('set', '', $methodName));
            return $this->data[$column]= $arguments[0];
        }

        else if ($substr === "get")
        {
            $column = lcfirst(str_replace('get', '', $methodName));
            if (isset($this->data[$column]))
            {
                return $this->data[$column];
            }
            else
            {
                return NULL;
            }
        }

        else
        {
            throw new \RuntimeException("This method does not exist.");
        }

    }

    protected function hydrateVars()
    {

        $this->vars = [];
    }

    //ALIASES
    public function save()
    {
        $this->manager->save($this);
    }
    public function delete($id)
    {
        $this->manager->delete($id);
    }

    public function load($id)
    {
        $this->data = $this->manager->load($id);
    }

    public function getCollection($orderby, $limit, $sort)
    {
        return $this->manager->getCollection($orderby, $limit, $sort);
    }

}