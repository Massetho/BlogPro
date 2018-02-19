<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 23/11/2017
 * Time: 14:09
 */
namespace App\Block;

class HeaderBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/PublicHeader.php';
    protected $block = 'header';
}


