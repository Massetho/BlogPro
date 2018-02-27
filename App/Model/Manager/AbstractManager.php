<?php
/**
 * @description : zdzdoizdj
 * @author : quent
 * @package : Blogpro
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

    //Formating function for SQL requests preparation
    public function placeholders($text, $count=0, $separator=","){
        $result = array();
        if($count > 0){
            for($x=0; $x<$count; $x++){
                $result[] = $text;
            }
        }

        return implode($separator, $result);
    }

    /**
     * @param AbstractEntity $obj
     * @return int
     */
    public function save(AbstractEntity $obj)
    {

        $columns = implode(',', array_keys($obj->getData()));
        $fields = array_values($obj->getData());
        $question_marks = '(' . $this->placeholders('?', sizeof($obj->getData())) . ')';

        $update = '';
        foreach (array_keys($obj->getData()) as $col)
        {
            $update .= " $col = VALUES($col),";
        }
        $update = trim($update, ",");

        $sql = "INSERT INTO ". $this->table . " (" . $columns . ")
                VALUES " . $question_marks . " 
                ON DUPLICATE KEY UPDATE $update";

        $pdo = $this->PDO->getPDO();
        $stmt = $pdo->prepare($sql);

        try {
            return $stmt->execute($fields);
        } catch (PDOException $e){
            echo $e->getMessage();
        }
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

    //return a table with entity infos
    public function dataById($id)
    {
        $idTable = 'id_' . $this->table;
        $statement = 'SELECT * FROM ' . $this->table . ' WHERE ' . $idTable . ' = ' . $id;
        $data = $this->PDO->query($statement);
        return $data[0];
    }

    //return last id
    public function lastId()
    {
        $idTable = 'id_' . $this->table;
        $statement = 'SELECT MAX('. $idTable .') FROM ' . $this->table;
        $data = $this->PDO->query($statement);
        return $data[0]["MAX($idTable)"];
    }


    //return an hydrated entity object
    public function load($id)
    {
        $data = $this->dataById($id);
        return new $this->entityPath($data);
    }

    public function delete($id)
    {
        $idTable = 'id_' . $this->table;
        $statement = 'DELETE FROM ' . $this->table . ' WHERE '. $idTable .' = ' . $id;
        return $this->PDO->deleteQuery($statement);
    }

    public function get($column, $value)
    {
        $statement = 'SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = ' . $value;
        $data = $this->PDO->query($statement);
        return $data;
    }

    //ALIASES
    public function pSQL($field)
    {
        return $this->PDO->pSQL($field);
    }
}