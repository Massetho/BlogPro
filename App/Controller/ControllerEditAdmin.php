<?php
/**
 * @description :
 * @package : PhpStorm.
 * @Author : quent
 * @date: 23/02/2018
 * @time: 14:15
 */
namespace App\Controller;
use App\Block\Form\AdminFormBlock;
use App\Block\BackHeaderBlock;
use App\Block\BackListAdminBlock;
use App\Model\Response;
use App\Model\Entity\Admin;

class ControllerEditAdmin extends ControllerBackend
{

    public function saveAdmin()
    {
        $password = $this->request->postData('password');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $data = array(
            'firstname' => $this->request->postData('firstname', FILTER_SANITIZE_STRING),
            'lastname' => $this->request->postData('lastname', FILTER_SANITIZE_STRING),
            'email' => $this->request->postData('email', FILTER_SANITIZE_EMAIL),
            'phone' => $this->request->postData('phone', FILTER_SANITIZE_NUMBER_INT),
            'date_created' => $this->getFormatedDate(),
            'password' => $password
        );

        $admin = new Admin($data);
        return $admin->save();
    }

    public function index()
    {
        if ($this->request->postExists('authForm')) {
            if ($this->authFormVerify()) {

                if (($this->request->postData('password') !== '') && ($this->request->postData('password') === $this->request->postData('repeatPassword'))) {
                    if(!$this->saveAdmin())
                    {
                        $response = new Response();
                        $response->redirect500();
                    }
                } else {
                    $response = new Response();
                    $response->redirect500();
                }
            }
        }

        if($this->request->sessionExists('idAdmin')) {
            $data = array('id' => $this->request->sessionData('idAdmin'));
            $page = $this->page;
            $page->setLayout( __DIR__ . '/../View/Layout/backLayout.php');

            //Creating blocks

            $page->addBlock(new BackHeaderBlock($this));
            $page->addBlock(new AdminFormBlock($this, new Admin($data)));

            $response = new Response();
            $response->setBody($page->render())->send();
        }
        else {
            $response = new Response();
            $response->redirect500();
        }
    }

    public function listAdmin()
    {
        $page = $this->page;
        $page->setLayout( __DIR__ . '/../View/Layout/backLayout.php');
        $page->addBlock(new BackListAdminBlock($this));
        $page->addBlock(new BackHeaderBlock($this));
        $response = new Response();
        $response->setBody($page->render())->send();
    }

    public function modifyAdminLevel()
    {
        if ($this->request->postExists('authForm') && $this->authFormVerify())
        {
            if ($this->request->postExists('access_level'))
            {
                if (!empty($this->vars['id'])) {
                    $admin = new Admin(array('id' => $this->vars['id']));
                    $admin->setAccess_level($this->request->postData('access_level', FILTER_SANITIZE_NUMBER_INT));
                    if (!$admin->save()) {
                        $response = new Response();
                        $response->redirect500();
                    }
                }
            }
        }

        $this->listAdmin();
    }

}

