<?php
/**
 * @description : Display block for a solo article
 * @package : BloPro
 * @Author : Quentin Thomasset
 * @date: 29/01/2018
 * @time: 16:36
 */

namespace App\Block;

use App\Model\Entity\Article;

class SoloArticleBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/ViewArticle.php'; //path to template
}
