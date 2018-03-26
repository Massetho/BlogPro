<?php
/**
 * @description : Class Block for the Contact Form
 * @package : BlogPro
 * @Author : Quentin Thomasset
 * @date: 05/02/2018
 * @time: 16:15
 */
namespace App\Block\Form;

class ContactFormBlock extends FormBlock
{
    protected $view = __DIR__ . '/../../View/Template/ViewContactForm.php';

    public function build()
    {
        $this->addField(new StringField([
            'label' => 'Name',
            'name' => 'name',
            'maxLength' => 100,
            'onblur' => 'verifField(this)'
        ]))
            ->addField(new StringField([
                'label' => 'E-mail',
                'name' => 'email',
                'maxLength' => 120,
                'onblur' => 'verifMail(this)'
            ]))
            ->addField(new TextField([
                'label' => 'Message',
                'name' => 'message',
                'rows' => 10,
                'cols' => 60
            ]))
            ->addField(new AuthField([
                'name' => 'authForm',
                'value' => $this->uniqid
            ]));
    }
}
