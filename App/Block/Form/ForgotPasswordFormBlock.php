<?php
/**
 * @description :
 * @package : PhpStorm.
 * @Author : quent
 * @date: 29/03/2018
 * @time: 09:41
 */

namespace App\Block\Form;

class ForgotPasswordFormBlock extends FormBlock
{
    protected $view = __DIR__ . '/../../View/Template/ViewForgotPasswordForm.php';

    public function build()
    {
        $this->addField(new StringField([
            'label' => 'E-mail',
            'name' => 'email',
            'maxLength' => 120
        ]))
            ->addField(new AuthField([
                'name' => 'authForm',
                'value' => $this->uniqid
            ]));
    }
}
