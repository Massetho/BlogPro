<?php
/**
 * @description : List all users
 * @package : PhpStorm.
 * @Author : quent
 * @date: 15/03/2018
 * @time: 16:45
 */
namespace App\Block;

use App\Model\Entity\Admin;

class BackListAdminBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/ViewBackAdminList.php'; //path to template
    protected $collection;

    public function __construct($controller)
    {
        parent::__construct($controller);
        $this->listAdmin();
    }

    public function listAdmin()
    {
        $collector = new Admin();
        $this->collection = $collector->getCollection();
    }
}

