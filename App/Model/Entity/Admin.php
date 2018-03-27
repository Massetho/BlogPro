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

    public function __construct($data = null)
    {
        parent::__construct($data);
        $this->request = new Request();
        if (!empty($data['id'])) {
            $this->data = $this->manager->dataById($data['id']);
        }
    }

    public function login($mail, $password)
    {
        $auth = $this->getColumn('email', $mail);

        if (password_verify($password, $auth['password'])) {
            $this->data = $auth;
            if ($this->setAuthenticated()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function setAuthenticated($authenticated = true)
    {
        if (!is_bool($authenticated)) {
            throw new \InvalidArgumentException('Parameter value for User::setAuthenticated() must be a boolean');
        }
        $this->request->sessionSet('authAdmin', $authenticated);

        if (empty($this->getAccess_level())) {
            return false;
        }
        $this->request->sessionSet('adminLevel', $this->getAccess_level());

        if (empty($this->getId_admin())) {
            return false;
        }
        $this->request->sessionSet('idAdmin', $this->getId_admin());

        return true;
    }

    public static function isAuthenticated()
    {
        $request = new Request();
        if (($request->sessionExists('authAdmin')) && ($request->sessionData('authAdmin') === true)) {
            if ($request->sessionExists('adminLevel')) {
                return $request->sessionData('adminLevel');
            }
            return false;
        } else {
            return false;
        }
    }
}
