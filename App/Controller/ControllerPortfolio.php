<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 18/12/2017
 * Time: 16:13
 */
namespace App\Controller;
use App\Model\Entity\Article;
use App\Model\Page;
use App\Model\Response;

class ControllerPortfolio extends ControllerAbstract
{

    public function index()
    {
        $page = $this->page;

        //Creating blocks
        array_map(function ($block) use ($page) {
            $className = 'App\\Block\\' . ucfirst($block) . 'Block';
            $page->addBlock(new $className($this));
        }, ['header', 'footer', 'project']);

        $response = new Response();
        echo $response->setBody($page->render())->send();
    }
}