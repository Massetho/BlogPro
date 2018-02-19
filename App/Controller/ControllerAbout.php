<?php
/**
 * @description :Controller for About Page
 * @package : BlogPro
 * @Author : Quentin Thomasset
 * @date: 05/02/2018
 * @time: 15:17
 */
namespace App\Controller;
use App\Block\Form\ContactFormBlock;
use App\Model\Page;
use App\Model\Response;

class ControllerAbout extends ControllerAbstract {

    public function index()
    {
        $page = $this->page;
        //Creating blocks
        array_map(function($block) use($page){
            $className = 'App\\Block\\'.ucfirst($block) . 'Block';
            $page->addBlock(new $className($this));
        }, ['header', 'footer', 'about', 'form\ContactForm']);

        $response = new Response();
        $response->setBody($page->render())->send();
    }

    public function contact()
    {
        if ($this->request->postExists('authForm'))
        {
            if ($this->authFormVerify())
            {
                $mail = $this->request->postData('email', FILTER_VALIDATE_EMAIL);
                $message = $this->request->postData('message', FILTER_SANITIZE_STRING);
                $headers ='From: ' . "$mail\r\n" .
                    'Reply-To: ' . "$mail\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                mail(_CONTACT_MAIL_,
                    "Contact Form from BlogPro",
                    $message,
                    $headers);
            }
        }

        $response  = new Response();
        $response->redirect($this->getUrl($this, 'index'));
    }
}
