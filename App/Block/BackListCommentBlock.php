<?php
/**
 * @description :
 * @package : PhpStorm.
 * @Author : quent
 * @date: 22/03/2018
 * @time: 15:22
 */

namespace App\Block;

use App\Model\Entity\Comment;

class BackListCommentBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/ViewBackCommentList.php'; //path to template
    protected $collection;
    public $uniqid;

    public function __construct($controller)
    {
        parent::__construct($controller);
        $this->listComment();

        $this->uniqid = uniqid();
        $_SESSION['authForm'] = $this->uniqid;
    }

    public function listComment()
    {
        $collector = new Comment();
        $this->collection = $collector->getCollection();
    }
}
