<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 23/11/2017
 * Time: 14:17
 */
namespace App\Block;

class FooterBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/PublicFooter.php';
    protected $name = 'footer';
}