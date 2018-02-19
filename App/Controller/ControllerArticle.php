<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 03/10/2017
 * Time: 17:28
 */
namespace App\Controller;
use App\Block\SoloArticleBlock;
use App\Model\Entity\Article;
use App\Model\Page;
use App\Model\Response;

class ControllerArticle extends ControllerAbstract {

    public function index()
    {
        $page = $this->page;

        //Creating blocks
        array_map(function($block) use($page){
            $className = 'App\\Block\\'.ucfirst($block) . 'Block';
            $page->addBlock(new $className($this));
        }, ['header', 'footer', 'article']);

        $response = new Response();
        $response->setBody($page->render())->send();
    }

    public function show()
    {
        $page = $this->page;

        if (!empty($this->vars))
        {
            array_map(function($block) use($page){
                $className = 'App\\Block\\'.ucfirst($block) . 'Block';
                $page->addBlock(new $className($this));
            }, ['header', 'footer']);
            $page->addBlock(new SoloArticleBlock($this, new Article($this->vars)));
        }
        else
        {
            $response = new Response();
            $response->redirect('https://blogpro.test/');
        }

        $response = new Response();
        $response->setBody($page->render())->send();
    }
}
