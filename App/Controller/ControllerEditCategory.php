<?php
/**
 * @description : Everything for managing Categories
 * @package : PhpStorm.
 * @Author : quent
 * @date: 13/02/2018
 * @time: 17:53
 */
namespace App\Controller;
use App\Block\Form\CategoryFormBlock;
use App\Block\BackHeaderBlock;
use App\Model\Response;
use App\Model\Entity\Category;

class ControllerEditCategory extends ControllerBackend
{
    public function index()
    {
        if ($this->request->postExists('authForm'))
        {
            if ($this->authFormVerify())
            {

                $data = array(
                    'name' => $this->request->postData('name', FILTER_SANITIZE_STRING)
                );
                if (!empty($this->vars['id']))
                    $data['id_category'] = $this->vars['id'];

                $article = new Category($data);
                if ($article->save())
                {
                    $response = new Response();
                    $response->redirect('https://blogpro.test/admin-category');
                }
            }
        }

        $page = $this->page;
        $page->setLayout( __DIR__ . '/../View/Layout/backLayout.php');

        $page->addBlock(new BackHeaderBlock($this));
        if (!empty($this->vars))
        {
            $page->addBlock(new CategoryFormBlock($this, new Category($this->vars)));
        }
        else
        {
            $page->addBlock(new CategoryFormBlock($this, new Category()));
        }

        $response = new Response();
        $response->setBody($page->render())->send();
    }

}