<?php
/**
 * @description : Register form for new users
 * @package : PhpStorm.
 * @Author : quent
 * @date: 15/03/2018
 * @time: 15:07
 */

namespace App\Block\Form;

class RegisterFormBlock extends FormBlock
{
    public function build()
    {
        $this->addField(new StringField([
            'label' => 'Firstname',
            'name' => 'firstname',
            'maxLength' => 100
        ]))
            ->addField(new StringField([
                'label' => 'Lastname',
                'name' => 'lastname',
                'maxLength' => 100
            ]))
            ->addField(new StringField([
                'label' => 'Email',
                'name' => 'email',
                'maxLength' => 125
            ]))
            ->addField(new PasswordField([
                'label' => 'Password',
                'name' => 'password',
                'maxLength' => 125,
            ]))
            ->addField(new PasswordField([
                'label' => 'Repeat Password',
                'name' => 'repeatPassword',
                'maxLength' => 125,
            ]))
            ->addField(new AuthField([
                'name' => 'authForm',
                'value' => $this->uniqid
            ]));
    }
}