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

    public function getExcerpt() {
        if (empty($this->excerpt))
        {
            $excerpt = substr($this->getBody(), 0, 25) . '...';
            $this->excerpt = $excerpt;
        }
        return $this->excerpt;
    }

    protected function hydrateVars()
    {
        //$this->vars = [urlencode($this->getTitle()), $this->getId_article()];
    }
}