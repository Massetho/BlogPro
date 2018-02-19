<?php
/**
 * @description :
 * @package : PhpStorm.
 * @Author : quent
 * @date: 13/02/2018
 * @time: 17:56
 */

namespace App\Block\Form;

class CategoryFormBlock extends FormBlock
{
    public function build()
    {
        $this->addField(new StringField([
            'label' => 'Name',
            'name' => 'name',
            'maxLength' => 100
        ]))
            ->addField(new AuthField([
                'name' => 'authForm',
                'value' => $this->uniqid
            ]));
    }
}