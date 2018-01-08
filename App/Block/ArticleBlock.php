<?php

namespace App\Block;
use App\Model\Entity\Article;

class ArticleBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/ViewHome.php'; //path to template
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
