<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 23/11/2017
 * Time: 17:10
 */
namespace App\Model\Entity;
use \App\Model\Manager\AdminManager;


class Admin extends AbstractEntity
{
    public function login($mail, $password)
    {
        $auth = $this->manager->get('email', '"'.$mail.'"');

        if (password_verify($password, $auth[0]['password']))
        {
            $this->setAuthenticated();
            return true;
        }
        else {
            return false;
        }
    }


    public function setAuthenticated($authenticated = true)
    {
        if (!is_bool($authenticated))
        {
            throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
        }
        $_SESSION['auth'] = $authenticated;
    }

    public static function isAuthenticated()
    {
        //return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
        if (isset($_SESSION['auth']) && ($_SESSION['auth'] === true))
        {
            return true;
        }
        else{
            return false;
        }
    }
}