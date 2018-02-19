<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 18/01/2018
 * Time: 11:48
 */

namespace App\Block;
use App\Model\Entity\Article;
use App\Controller\ControllerEditArticle;

class BackListArticleBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/ViewBackArticleList.php'; //path to template
    protected $collection;

    public function __construct($controller)
    {
        parent::__construct($controller);
        $this->listArticle();
    }

    public function listArticle()
    {
        $collector = new Article();
        $this->collection = $collector->getCollection('date_created', 'DESC', 5);
    }


    public function show()
    {

    }

}
