<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 27/11/2017
 * Time: 17:52
 */
namespace App\Controller;
use App\Model\Entity\Article;
use App\Model\Page;
use App\Model\Response;
use App\Model\Block\ArticleBlock;
use App\Model\Block\HeaderBlock;
use App\Model\Block\FooterBlock;

class ControllerNews extends ControllerAbstract
{
    /*public function showNews()
    {
        $news =
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

        if (empty($news))
        {
            $this->app->httpResponse()->redirect404();
        }

        $this->page->addVar('title', $news->titre());
        $this->page->addVar('news', $news);
    }*/
}
