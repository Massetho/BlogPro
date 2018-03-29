<?php
/**
 * @description :
 * @package : PhpStorm.
 * @Author : quent
 * @date: 29/03/2018
 * @time: 10:07
 */

namespace App\Block\Form;

class NewPasswordFormBlock extends FormBlock
{
    protected $view = __DIR__ . '/../../View/Template/ViewNewPasswordForm.php';

    public function build()
    {
        $this->addField(new PasswordField([
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
