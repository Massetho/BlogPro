<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 11/01/2018
 * Time: 11:30
 */

namespace App\Block\Form;

class ArticleFormBlock extends FormBlock
{
    public function build()
    {
        $this->addField(new StringField([
            'label' => 'Titre',
            'name' => 'title',
            'maxLength' => 100
        ]))
        ->addField(new TextField([
            'label' => 'Chapeau',
            'name' => 'introduction',
            'rows' => 2,
            'cols' => 60
        ]))
        ->addField(new TextField([
            'label' => 'Contenu',
            'name' => 'body',
            'rows' => 10,
            'cols' => 60
        ]))
        ->addField(new SelectCatField([
            'label' => 'Category',
            'name' => 'article_category'
        ]))
        ->addField(new AuthField([
            'name' => 'authForm',
            'value' => $this->uniqid
        ]));
    }
}