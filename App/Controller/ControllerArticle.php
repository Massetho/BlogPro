<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 03/10/2017
 * Time: 17:28
 */
namespace App\Controller;

use App\Block\CommentListBlock;
use App\Block\Form\CommentFormBlock;
use App\Block\SoloArticleBlock;
use App\Model\Entity\Article;
use App\Model\Entity\Comment;
use App\Model\Page;
use App\Model\Response;

class ControllerArticle extends ControllerAbstract
{
    public function index()
    {
        $page = $this->page;

        //Creating blocks
        array_map(function ($block) use ($page) {
            $className = 'App\\Block\\'.ucfirst($block) . 'Block';
            $page->addBlock(new $className($this));
        }, ['header', 'footer', 'article']);

        $response = new Response();
        $response->setBody($page->render())->send();
    }

    public function show()
    {
        $page = $this->page;
        if (!empty($this->vars)) {
            array_map(function ($block) use ($page) {
                $className = 'App\\Block\\'.ucfirst($block) . 'Block';
                $page->addBlock(new $className($this));
            }, ['header', 'footer']);
            $page->addBlock(new SoloArticleBlock($this, new Article($this->vars)));
            $commentBlock = new CommentListBlock($this, new Article($this->vars));
            if ($this->checkAdmin()) {
                $page->addBlock(new CommentFormBlock($this, new Article($this->vars)));
            } else {
                $msg = '<p>Please <b><a href="'.$this->getUrl($this, 'login', array(), 'Login').'">login</a></b> or <b><a href="'.$this->getUrl($this, 'register', array(), 'Login').'">register</a></b> to write a comment.</p>';
                $commentBlock->setMessage($msg);
            }

            $page->addBlock($commentBlock);
        } else {
            $response = new Response();
            $response->redirect('https://blogpro.test/');
        }

        $response = new Response();
        $response->setBody($page->render())->send();
    }

    public function registerComment()
    {
        if ($this->authFormVerify()) {
            if ((!empty($this->vars)) && $this->request->sessionExists('idAdmin')) {
                $msg = '';

                $data = array(
                    'comment_article' => $this->vars['id'],
                    'comment_admin' => $this->request->sessionData('idAdmin'),
                    'date_created' => $this->getFormatedDate());

                if (!$this->request->postExists('content') || (strlen($this->request->postData('content', FILTER_SANITIZE_STRING)) < 2)) {
                    $msg = 'Error : empty comment.';
                } else {
                    $data['content'] = $this->request->postData('content', FILTER_SANITIZE_STRING);
                    $comment = new Comment($data);
                    if ($comment->save()) {
                        $msg = 'Your comment must be validated before publication.';
                    } else {
                        $msg = 'Error while saving your comment.';
                    }
                }
            }
        }


        $page = $this->page;
        if (!empty($this->vars)) {
            array_map(function ($block) use ($page) {
                $className = 'App\\Block\\'.ucfirst($block) . 'Block';
                $page->addBlock(new $className($this));
            }, ['header', 'footer']);
            $page->addBlock(new SoloArticleBlock($this, new Article($this->vars)));
            $page->addBlock(new CommentListBlock($this, new Article($this->vars)));
            if ($this->checkAdmin()) {
                $form = new CommentFormBlock($this, new Article($this->vars));
                if (isset($msg)) {
                    $form->setMessage($msg);
                }
                $page->addBlock($form);
            }
            $response = new Response();
            $response->setBody($page->render())->send();
        } else {
            $response = new Response();
            $response->redirect('https://blogpro.test/');
        }
    }
}
