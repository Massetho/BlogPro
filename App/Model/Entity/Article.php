<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 25/10/2017
 * Time: 16:37
 */

namespace App\Model\Entity;
use \App\Model\Manager\ArticleManager;

class Article extends AbstractEntity
{
    public $excerpt;

    public function __construct($data = NULL)
    {
        $this->getManager();
        if ($data && is_array($data))
        {
            $this->data = $data;
            if (!empty($data['id']))
            {
                $this->data = $this->manager->dataById($data['id']);
                $this->getCategory();
            }
        }
    }

    public function getExcerpt() {
        if (empty($this->excerpt))
        {
            $excerpt = substr($this->getBody(), 0, 25) . '...';
            $this->excerpt = $excerpt;
        }
        return $this->excerpt;
    }

    public function getCategory()
    {
        if ($this->getArticle_category())
        {
            $category = new Category();
            $category->dataById($this->getArticle_category());
            return $this->setCategory($category->getName());
        }
        else
        {
            return false;
        }
    }
}