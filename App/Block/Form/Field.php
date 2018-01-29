<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 11/01/2018
 * Time: 10:35
 */
namespace App\Block\Form;

use App\Model\Call;

abstract class Field
{
    use Call;

    protected $data = [];

    public function __construct(array $data = [])
    {
        if (!empty($data))
        {
            $this->data = $data;
        }
    }

    abstract public function buildWidget();

}