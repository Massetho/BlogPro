<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 10/01/2018
 * Time: 15:26
 */

namespace App\Model;

trait Call
{
    public function __call($methodName, $arguments)
    {
        $substr = substr($methodName, 0, 3);
        if ($substr === "set") {
            $column = lcfirst(str_replace('set', '', $methodName));
            return $this->data[$column]= $arguments[0];
        } elseif ($substr === "get") {
            $column = lcfirst(str_replace('get', '', $methodName));
            if (isset($this->data[$column])) {
                return $this->data[$column];
            } else {
                return null;
            }
        } else {
            throw new \RuntimeException("This method does not exist.");
        }
    }
}
