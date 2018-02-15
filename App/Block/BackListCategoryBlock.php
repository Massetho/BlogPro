<?php
/**
 * @description : Block for Category Management
 * @package : BlogPro
 * @Author : Quentin Thomasset
 * @date: 13/02/2018
 * @time: 16:51
 */

namespace App\Block;
use App\Model\Entity\Category;

class BackListCategoryBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/ViewBackCategoryList.php'; //path to template
    protected $collection;

    public function __construct($controller)
    {
        parent::__construct($controller);
        $this->listCategory();
    }

    public function listCategory()
    {
        $collector = new Category();
        $this->collection = $collector->getCollection();
    }

}
