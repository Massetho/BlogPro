<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 11/01/2018
 * Time: 16:01
 */
namespace App\Controller;
use App\Block\Form\ArticleFormBlock;
use App\Block\BackHeaderBlock;
use App\Model\Response;
use App\Model\Entity\Article;

class ControllerEditArticle extends ControllerBackend
{
    public function index()
    {
        if ($this->request->postExists('authForm'))
        {
            if ($this->authFormVerify())
            {

                $data = array(
                    'title' => $this->request->postData('title'),
                    'introduction' => $this->request->postData('introduction'),
                    'body' => $this->request->postData('body'),
                    'article_category' => $this->request->postData('article_category'),
                    'date_created' => $this->getFormatedDate(),
                    'image' => $this->request->fileName('image')
                );
                if (!empty($this->vars['id']))
                    $data['id_article'] = $this->vars['id'];

                if (empty($this->request->fileName('image')))
                    unset($data['image']);

                $article = new Article($data);
                $article->save();

                if (empty($this->vars['id']))
                    $data['id_article'] = $article->lastId();

                $folder = _IMG_ARTICLE_FILE_.$data['id_article'];

                if (($folder !== _IMG_ARTICLE_FILE_) && ($this->uploadImage($folder)))
                {
                    $response = new Response();
                    $response->redirect('https://blogpro.test/admin-dashboard');
                }
            }
        }

        $page = $this->page;
        $page->setLayout( __DIR__ . '/../View/Layout/backLayout.php');

        //if ($this->request->postExists(''))
        //Creating blocks

        $page->addBlock(new BackHeaderBlock($this));
        if (!empty($this->vars))
        {
            $page->addBlock(new ArticleFormBlock($this, new Article($this->vars)));
        }
        else
        {
            $page->addBlock(new ArticleFormBlock($this, new Article()));
        }

        $response = new Response();
        $response->setBody($page->render())->send();
    }

}