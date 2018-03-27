<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 03/10/2017
 * Time: 17:28
 */
namespace App\Controller;

use App\Model\Page;
use App\Model\Response;
use App\Block\LoginBlock;
use App\Block\Form\RegisterFormBlock;
use App\Model\Entity\Admin;

class ControllerLogin extends ControllerAbstract
{
    public function saveAdmin()
    {
        $email = $this->request->postData('email', FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $password = $this->request->postData('password');
            $password = password_hash($password, PASSWORD_DEFAULT);

            $data = array(
                'firstname' => $this->request->postData('firstname', FILTER_SANITIZE_STRING),
                'lastname' => $this->request->postData('lastname', FILTER_SANITIZE_STRING),
                'email' => $this->request->postData('email', FILTER_SANITIZE_EMAIL),
                'date_created' => $this->getFormatedDate(),
                'password' => $password
            );

            $admin = new Admin($data);
            return $admin->save();
        } else {
            return false;
        }
    }

    public function login()
    {
        if ($this->request->postExists('username')) {
            $admin = new Admin();
            $login = $this->request->postData('username');
            $password = $this->request->postData('password');
            if ($admin->login($login, $password)) {
                $response = new Response();
                $response->redirect('http://blogpro.test/admin-dashboard');
            }
        } elseif (Admin::isAuthenticated() == _AUTH_ADMIN_) {
            $response = new Response();
            $response->redirect('http://blogpro.test/admin-dashboard');
        } elseif (Admin::isAuthenticated() == _USER_ADMIN_) {
            $response = new Response();
            $response->redirect('http://blogpro.test/');
        }

        $page = new Page();
        $page->setLayout(__DIR__ . '/../View/Layout/loginLayout.php');

        //Creating blocks
        array_map(function ($block) use ($page) {
            $className = 'App\\Block\\' . ucfirst($block) . 'Block';
            $page->addBlock(new $className($this));
        }, ['login']);

        $response = new Response();
        $response->setBody($page->render())->send();
    }

    public function register()
    {
        if ($this->authFormVerify()) {
            if (($this->request->postData('password') !== '') && ($this->request->postData('password') === $this->request->postData('repeatPassword'))) {
                $admin = new Admin();
                if ($test = $admin->getColumn('email', $this->request->postData('email', FILTER_SANITIZE_EMAIL))) {
                    $msg = 'Error : email address is already used.';
                } else {
                    if ($this->saveAdmin()) {
                        $msg = 'Registration complete. Please wait for your validation email.';
                    } else {
                        $msg = 'Error while registering.';
                    }
                }
            } else {
                $msg = 'Error : incorrect password';
            }
        }

        $page = $this->page;
        $page->setLayout(__DIR__ . '/../View/Layout/layout.php');

        //Creating blocks
        array_map(function ($block) use ($page) {
            $className = 'App\\Block\\'.ucfirst($block) . 'Block';
            $page->addBlock(new $className($this));
        }, ['header', 'footer']);
        $form = new RegisterFormBlock($this);
        if (isset($msg)) {
            $form->setMessage($msg);
        }
        $page->addBlock($form);

        $response = new Response();
        $response->setBody($page->render())->send();
    }
}
