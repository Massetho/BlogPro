<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 26/10/2017
 * Time: 14:49
 */

namespace App\Model\Manager;

use App\Model\Database;
use App\Model\Entity\AbstractEntity;

abstract class AbstractManager
{
    protected $PDO;
    protected $className;
    protected $table;
    protected $entityPath;

    public function __construct()
    {
        $this->PDO = Database::getInstance();
        $this->className = str_replace(array('App\Model\Manager\\','Manager'), array('', ''),static::class);
        $this->table = lcfirst($this->className);
        $this->entityPath = 'App\Model\Entity\\'. $this->className;
    }

    public function save(AbstractEntity $obj)
    {

        //USE IMPLODE array_keys array_values INSTEAD
        /* $columns = "";
        $fields = "";
        foreach ($obj->getData() as $key => $value)
        {
            $columns .= $key . ',';
            $fields .= $value . ',';
        }
        $columns = trim($columns, ",");
        $fields = trim($fields, ","); */

        $columns = implode(',', array_keys($obj->getData()));
        $fields = implode(',', array_values($obj->getData()));

        $statement = 'INSERT INTO ' . $this->table .'('. $columns .')' . ' VALUES ('. $fields .') ON DUPLICATE KEY UPDATE';
        return $this->PDO->query($statement);
    }

    public function getCollection($orderby = NULL, $sort = 'ASC', $limit = '0')
    {
        if ($orderby !== NULL)
        {
            $statement = 'SELECT * FROM '. $this->table . ' ORDER BY '. $orderby .' '. $sort . ' LIMIT ' . $limit;
        }
        else
        {
            $statement = 'SELECT * FROM '. $this->table;
        }

        $tables = $this->PDO->query($statement);

        //Transform results into usable objects.
        $collection=[];
        foreach ($tables as $x =>$item)
        {
            $collection[$x] = new $this->entityPath($item);
        }

        return $collection;
    }


    public function dataById($id)
    {
        $idTable = 'id_' . $this->table;
        $statement = 'SELECT * FROM ' . $this->table . ' WHERE ' . $idTable . ' = ' . $id;
        $data = $this->PDO->query($statement);
        return $data[0];
    }

    public function load($id)
    {
        $data = $this->dataById($id);
        return new $this->entityPath($data);
    }

    public function delete($id)
    {
        $idTable = 'id_' . $this->table;
        $statement = 'DELETE FROM ' . $this->table . ' WHERE '. $idTable .' = ' . $id;
        return $this->PDO->query($statement);
    }

    public function add()
    {

    }

    public function get($column, $value)
    {
        $statement = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = ' . $value;
        $data = $this->PDO->query($statement);
        return $data;
    }
}