<?php
/**
 * @description : Header Block for back Office
 * @package : BlogPro
 * @Author : Quentin Thomasset
 * @date: 26/01/2018
 * @time: 15:11
 */
namespace App\Block;

class BackHeaderBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../View/Template/BackHeader.php';
    protected $block = 'header';
}
