<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 20/12/2017
 * Time: 13:44
 */

namespace App\Controller;
use App\Model\Entity\Article;
use App\Model\Response;
use App\Block\BackListArticleBlock;
use App\Block\BackHeaderBlock;
use App\Model\Entity\Admin;

class ControllerBackend extends ControllerAbstract
{

    public function __construct($router, $request, $vars)
    {
        parent::__construct($router, $request, $vars);
        $this->checkAdmin();
    }

    public function checkAdmin()
    {
        if (!(Admin::isAuthenticated()))
        {
            $response = new Response();
            $response->redirect('https://blogpro.test/admin/');
        }
    }

    public function listArticle()
    {
        $page = $this->page;
        $page->setLayout( __DIR__ . '/../View/Layout/backLayout.php');
        $page->addBlock(new BackListArticleBlock($this));
        $page->addBlock(new BackHeaderBlock($this));
        $response = new Response();
        echo $response->setBody($page->render())->send();
    }

    public function deleteArticle()
    {
        if (!empty($this->vars['id']))
        {
            $article = new Article();
            $article->delete($this->vars['id']);
        }
        $this->listArticle();
    }
}