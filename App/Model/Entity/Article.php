<?php

namespace App\Model\Entity;

use \App\Model\Manager\ArticleManager;

/**
 * Class Article
 * @package App\Model\Entity
 *
 * @method string getTitle()
 * @method setTitle($title)
 */
class Article extends AbstractEntity
{
    public $excerpt;
    public $comments;

    public function __construct($data = null)
    {
        $this->getManager();
        if ($data && is_array($data)) {
            $this->data = $data;
            if (!empty($data['id'])) {
                $this->data = $this->manager->dataById($data['id']);
                $this->getCategory();
            }
        }
    }

    public function getExcerpt()
    {
        if (empty($this->excerpt)) {
            $excerpt = substr($this->getBody(), 0, 25) . '...';
            $this->excerpt = $excerpt;
        }
        return $this->excerpt;
    }

    public function getCategory()
    {
        if ($this->getArticle_category()) {
            $category = new Category();
            $category->dataById($this->getArticle_category());
            return $this->setCategory($category->getName());
        } else {
            return false;
        }
    }

    public function getImageArticle($key = null)
    {
        if (isset($this->data['id'])) {
            $id = $this->data['id'];
        }
        if (isset($this->data['id_article'])) {
            $id = $this->data['id_article'];
        }
        if ($id) {
            $path = _HOME_DIR_._IMG_FILE_ . _IMG_ARTICLE_FILE_ .$id.'/*.{jpg,jpeg,gif,png}';
            $files = glob($path, GLOB_BRACE);
            $images = [];
            foreach ($files as $image) {
                $image = str_replace(_HOME_DIR_, '', $image);
                $images[] = $image;
            }
            if ($key !== null && is_int($key)) {
                return $images[$key];
            } else {
                return $images;
            }
        } else {
            return false;
        }
    }

    public function getThumbnailArticle($key = null)
    {
        if (isset($this->data['id'])) {
            $id = $this->data['id'];
        }
        if (isset($this->data['id_article'])) {
            $id = $this->data['id_article'];
        }
        if ($id) {
            $path = _HOME_DIR_._IMG_FILE_ . _IMG_ARTICLE_FILE_ .$id.'/thumbnail/*.{jpg,jpeg,gif,png}';
            $files = glob($path, GLOB_BRACE);
            $images = [];
            foreach ($files as $image) {
                $image = str_replace(_HOME_DIR_, '', $image);
                $images[] = $image;
            }
            if ($key !== null && is_int($key)) {
                return $images[$key];
            } else {
                return $images;
            }
        } else {
            return false;
        }
    }
}
