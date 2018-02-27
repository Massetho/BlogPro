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
use App\Model\Response;
use App\Model\Entity\Admin;

class ControllerEditAdmin extends ControllerBackend
{
    public function index()
    {
        if ($this->request->postExists('authForm'))
        {
            if ($this->authFormVerify())
            {

                if (($this->request->postData('password') !== '') && ($this->request->postData('password') === $this->request->postData('repeatPassword')))
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
                    $admin->save();
                }
            }
        }

        $page = $this->page;
        $page->setLayout( __DIR__ . '/../View/Layout/backLayout.php');

        //Creating blocks

        $page->addBlock(new BackHeaderBlock($this));
        $data = array('id' => 1);
        $page->addBlock(new AdminFormBlock($this, new Admin($data)));

        $response = new Response();
        $response->setBody($page->render())->send();
    }

}