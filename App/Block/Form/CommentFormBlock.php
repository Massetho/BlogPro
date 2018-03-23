<?php
/**
 * @description :
 * @package : PhpStorm.
 * @Author : quent
 * @date: 21/03/2018
 * @time: 11:29
 */

namespace App\Block\Form;

class CommentFormBlock extends FormBlock
{
    protected $view = __DIR__ . '/../../View/Template/ViewCommentForm.php';
    protected $block = 'commentForm';

    public function build()
    {
        $this->addField(new TextField([
                'label' => 'Content',
                'name' => 'content',
                'rows' => 10,
                'cols' => 60,
                'maxLength' => 1000
            ]))
            ->addField(new AuthField([
                'name' => 'authForm',
                'value' => $this->uniqid
            ]));
    }
}