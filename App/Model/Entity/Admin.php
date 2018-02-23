<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 23/11/2017
 * Time: 17:10
 */
namespace App\Model\Entity;
use \App\Model\Manager\AdminManager;
use App\Model\Request;


class Admin extends AbstractEntity
{
    protected $request;

    public function __construct($data = NULL)
    {
        parent::__construct($data);
        $this->request = new Request();
        if (!empty($data['id']))
        {
            $this->data = $this->manager->dataById($data['id']);
        }
    }

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
            throw new \InvalidArgumentException('Parameter value for User::setAuthenticated() must be a boolean');
        }
        $this->request->sessionSet('authAdmin', $authenticated);
    }

    public static function isAuthenticated()
    {
        $request = new Request();
        if (($request->sessionExists('authAdmin')) && ($request->sessionData('authAdmin') === true))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}