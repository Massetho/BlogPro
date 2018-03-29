<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 03/10/2017
 * Time: 17:28
 */
namespace App\Controller;

use App\Block\Form\ForgotPasswordFormBlock;
use App\Block\Form\NewPasswordFormBlock;
use App\Model\Page;
use App\Model\Response;
use App\Block\LoginBlock;
use App\Block\Form\RegisterFormBlock;
use App\Model\Entity\Admin;
use \SendGrid;

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
                if ($admin->getColumn('email', $this->request->postData('email', FILTER_SANITIZE_EMAIL))) {
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

    public function forgotPassword()
    {
        if ($this->authFormVerify() && ($this->request->postExists('email'))) {
            $email = $this->request->postData('email', FILTER_SANITIZE_EMAIL);

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $admin = new Admin();
                $data = $admin->getColumn('email', $email);
                if (!empty($data)) {
                    $user = new Admin($data);
                    $token = uniqid();
                    $user->setToken($token);

                    //Make message
                    $url = $this->getUrl($this, 'newPassword', array($user->getId_admin(), $token));
                    $content = '<p>You asked for a password reset. If you want to change your password, please follow this link :</p> <br> <p>http://blogpro.test' . $url . '</p>';

                    //SEND MAIL with Token
                    $from = new SendGrid\Email("Blogpro", _CONTACT_MAIL_);
                    $subject = "Forgot Password on BlogPro";
                    $to = $user->getFirstname() . ' ' . $user->getLastname();
                    $to = new SendGrid\Email($to, $email);

                    $content = new SendGrid\Content("text/html", $content);
                    $mail = new SendGrid\Mail($from, $subject, $to, $content);

                    $sg = new \SendGrid(_SENDGRID_API_KEY_);
                    $sg->client->mail()->send()->post($mail);

                    //SAVE TOKEN IN DATABASE
                    if ($user->save()) {
                        $msg = 'Email sent. Please check your inbox.';
                    }
                    else {
                        $response = new Response();
                        $response->redirect500();
                    }
                }
                else {
                    $msg = 'Error : email address do not exist.';
                }
            } else {
                $msg = 'Error : incorrect email.';
            }
        }

        $page = $this->page;
        $page->setLayout(__DIR__ . '/../View/Layout/layout.php');

        //Creating blocks
        array_map(function ($block) use ($page) {
            $className = 'App\\Block\\'.ucfirst($block) . 'Block';
            $page->addBlock(new $className($this));
        }, ['header', 'footer']);
        $form = new ForgotPasswordFormBlock($this);
        if (isset($msg)) {
            $form->setMessage($msg);
        }
        $page->addBlock($form);

        $response = new Response();
        $response->setBody($page->render())->send();
    }

    public function checkToken(Admin $admin) {
        if (isset($this->vars['token'])) {
            if ($this->vars['token'] == $admin->getToken()) {
                return true;
            }
        }
        return false;
    }

    public function newPassword()
    {
        $admin = new Admin(array('id' => $this->vars['id']));
        if ($this->checkToken($admin)) {

            if ($this->authFormVerify()) {
                if (($this->request->postData('password') === $this->request->postData('repeatPassword'))) {
                    if (strlen($this->request->postData('password')) < 5) {
                        $msg = 'Error : Password must be at least 5 characters long.';
                    }
                    else {
                        $password = $this->request->postData('password');
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $admin->setPassword($password);
                        if ($admin->save()) {
                            $msg = 'Your password has been successfully updated.';
                        }
                        else {
                            $response = new Response();
                            $response->redirect500();
                        }
                    }
                }
                else {
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
            $form = new NewPasswordFormBlock($this);
            if (isset($msg)) {
                $form->setMessage($msg);
            }
            $page->addBlock($form);

            $response = new Response();
            $response->setBody($page->render())->send();
        }
        else {
            $response = new Response();
            $response->redirect('http://blogpro.test/');
        }
    }
}
