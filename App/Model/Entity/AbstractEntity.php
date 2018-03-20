<?php
/**
 * @description : Abstract class for entities
 * @author: Quentin Thomasset
 * @package : BlogPro
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

    /**
     * AbstractEntity constructor.
     * @param null $data
     */
    public function __construct($data = NULL)
    {
        $this->getManager();
        if ($data && is_array($data))
        {
            $this->data = $data;
            if (!empty($data['id']))
                $this->data = $this->manager->dataById($data['id']);
        }
    }

    /**
     * GETTERS
     */
    public function getManager()
    {
        $managerName = str_replace('Entity', 'Manager', static::class);
        $managerName =  $managerName . 'Manager';
        $this->manager = new $managerName;
    }

    public function getData()
    {
        return $this->data;
    }

    public function __call($methodName, $arguments)
    {
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

    //DATE MANAGEMENT
    public function getFormatedDate()
    {
        $dayFormatter = new \IntlDateFormatter('fr_FR',\IntlDateFormatter::FULL,
            NULL,
            'Europe/Paris',
            \IntlDateFormatter::GREGORIAN );
        return $dayFormatter;
    }

    public function getDayInTheMonth($date)
    {
        $dayFormatter = $this->getFormatedDate();
        $dayFormatter->setPattern("d");
        $date = new \DateTime($date);
        return $dayFormatter->format($date);
    }

    public function getFrenchMonthYear($date)
    {
        $dayFormatter = $this->getFormatedDate();
        $dayFormatter->setPattern("MMMM y");
        $date = new \DateTime($date);
        return $dayFormatter->format($date);
    }


    //ALIASES
    public function save()
    {
        return $this->manager->save($this);
    }

    public function delete($id)
    {
        return $this->manager->delete($id);
    }

    public function dataById($id)
    {
        return $this->data = $this->manager->dataById($id);
    }

    public function getCollection($orderby = NULL, $sort = 'ASC', $limit = '0')
    {
        return $this->manager->getCollection($orderby, $sort, $limit);
    }

    public function lastId()
    {
        return $this->manager->lastId();
    }

    public function getColumn($column, $value)
    {
        return $this->manager->get($column, $value);
    }

}