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

    public function getImageArticle($key = NULL)
    {
        if (isset($this->data['id'])) $id = $this->data['id'];
        if (isset($this->data['id_article'])) $id = $this->data['id_article'];
        if($id)
        {
            $path = _HOME_DIR_._IMG_FILE_ . _IMG_ARTICLE_FILE_ .$id.'/*.{jpg,jpeg,gif,png}';
            $files = glob($path,GLOB_BRACE);
            $images = [];
            foreach ($files as $image)
            {
                $image = str_replace(_HOME_DIR_, '', $image);
                $images[] = $image;
            }
            if ($key !== NULL && is_int($key))
            {
                return $images[$key];
            }
            else
            {
                return $images;
            }
        }
        else
        {
            return false;
        }
    }

    public function getThumbnailArticle($key = NULL)
    {
        if (isset($this->data['id'])) $id = $this->data['id'];
        if (isset($this->data['id_article'])) $id = $this->data['id_article'];
        if($id)
        {
            $path = _HOME_DIR_._IMG_FILE_ . _IMG_ARTICLE_FILE_ .$id.'/thumbnail/*.{jpg,jpeg,gif,png}';
            $files = glob($path,GLOB_BRACE);
            $images = [];
            foreach ($files as $image)
            {
                $image = str_replace(_HOME_DIR_, '', $image);
                $images[] = $image;
            }
            if ($key !== NULL && is_int($key))
            {
                return $images[$key];
            }
            else
            {
                return $images;
            }
        }
        else
        {
            return false;
        }
    }

}