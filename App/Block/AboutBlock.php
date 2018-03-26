<?php
/**
 * @description : Block for the presentation page
 * @package : BlogPro
 * @Author : Quentin Thomasset
 * @date: 05/02/2018
 * @time: 15:07
 */

namespace App\Block;

use App\Model\Entity\Article;

class AboutBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/ViewAbout.php'; //path to template
}
