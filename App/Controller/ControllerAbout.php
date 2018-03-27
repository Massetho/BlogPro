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
use \SendGrid;

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
                if ($this->request->postData('email', FILTER_VALIDATE_EMAIL)) {

                    $from = $this->request->postData('email', FILTER_VALIDATE_EMAIL);

                    $from = new SendGrid\Email("Contact Form", $from);
                    $subject = "Contact Form from BlogPro";
                    $to = new SendGrid\Email("BlogPro", _CONTACT_MAIL_);
                    $content = new SendGrid\Content("text/plain", $this->request->postData('message', FILTER_SANITIZE_STRING));
                    $mail = new SendGrid\Mail($from, $subject, $to, $content);

                    $sg = new \SendGrid(_SENDGRID_API_KEY_);
                    $sg->client->mail()->send()->post($mail);
                }

            }
        }

        $response  = new Response();
        $response->redirect($this->getUrl($this, 'index'));
    }
}

