<?php
/**
 * @description : Global view of categories
 * @package : PhpStorm.
 * @Author : quent
 * @date: 08/02/2018
 * @time: 16:52
 */
namespace App\Controller;
use App\Block\BackHeaderBlock;
use App\Model\Response;
use App\Model\Entity\Category;
use App\Block\BackListCategoryBlock;

class ControllerCategory extends ControllerBackend
{
    public function listCategory()
    {
        $page = $this->page;
        $page->setLayout( __DIR__ . '/../View/Layout/backLayout.php');
        $page->addBlock(new BackListCategoryBlock($this));
        $page->addBlock(new BackHeaderBlock($this));
        $response = new Response();
        $response->setBody($page->render())->send();
    }

    public function deleteCategory()
    {
        if (!empty($this->vars['id']))
        {
            $category = new Category();
            $category->delete($this->vars['id']);
        }
        $this->listCategory();
    }
}