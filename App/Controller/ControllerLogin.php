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
use App\Model\Entity\Admin;

class ControllerLogin extends ControllerAbstract {

    public function login()
    {
        if ($this->request->postExists('username'))
        {
            $admin = new Admin();
            $login = $this->request->postData('username');
            $password = $this->request->postData('password');
            if ($admin->login($login, $password))
            {
                $response = new Response();
                $response->redirect('http://blogpro.test/admin-dashboard');
            }
        }

        elseif (Admin::isAuthenticated())
        {
            $response = new Response();
            $response->redirect('http://blogpro.test/admin-dashboard');
        }

        else {

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
    }
}
