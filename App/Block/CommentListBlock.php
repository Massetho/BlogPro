<?php
/**
 * @description :
 * @package : PhpStorm.
 * @Author : quent
 * @date: 21/03/2018
 * @time: 11:44
 */

namespace App\Block;

use App\Model\Entity\Comment;

class CommentListBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/ViewComment.php'; //path to template
    protected $block = 'comments'; //name of the variable where the block will show
    protected $collection;

    public function __construct($controller, $entity = NULL)
    {
        parent::__construct($controller, $entity);
        $this->listComments();
    }

    public function listComments()
    {
        if ($idArticle = $this->entity->getId_article())
        {
            $collector = new Comment();
            $this->collection = $collector->getComments($idArticle);
        }
        return null;
    }
}
