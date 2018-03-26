<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 18/12/2017
 * Time: 16:25
 */
namespace App\Block;

use App\Model\Entity\Project;

class ProjectBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/ViewPortfolio.php'; //path to template
    protected $collection;

    public function __construct($controller)
    {
        parent::__construct($controller);
        $this->listProjects();
    }

    public function listProjects()
    {
        $collector = new Project();
        $this->collection = $collector->getCollection('date_start', 'DESC', 5);
    }
}
