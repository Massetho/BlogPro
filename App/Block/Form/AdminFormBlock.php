<?php
/**
 * @description : Form for editing Administrator infos
 * @package : BlogPro
 * @Author : Quentin Thomasset
 * @date: 23/02/2018
 * @time: 14:20
 */
namespace App\Block\Form;

class AdminFormBlock extends FormBlock
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
            ->addField(new StringField([
                'label' => 'Phone',
                'name' => 'phone',
                'maxLength' => 10
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
