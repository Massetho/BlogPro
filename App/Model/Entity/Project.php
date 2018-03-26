<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 18/12/2017
 * Time: 16:11
 */
namespace App\Model\Entity;

use \App\Model\Manager\ArticleManager;

class Project extends AbstractEntity
{
    public $excerpt;

    public function getExcerpt()
    {
        if (empty($this->excerpt)) {
            $excerpt = substr($this->getMission(), 0, 25) . '...';
            $this->excerpt = $excerpt;
        }
        return $this->excerpt;
    }
}
