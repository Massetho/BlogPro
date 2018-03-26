<?php
/**
 * @description :
 * @package : PhpStorm.
 * @Author : quent
 * @date: 22/03/2018
 * @time: 15:10
 */

namespace App\Controller;

use App\Block\BackHeaderBlock;
use App\Block\BackListCommentBlock;
use App\Model\Entity\Comment;
use App\Model\Response;

class ControllerEditComment extends ControllerBackend
{

    public function listComment()
    {
        $page = $this->page;
        $page->setLayout( __DIR__ . '/../View/Layout/backLayout.php');
        $page->addBlock(new BackListCommentBlock($this));
        $page->addBlock(new BackHeaderBlock($this));
        $response = new Response();
        $response->setBody($page->render())->send();
    }

    public function modifyValidateComment()
    {
        if ($this->authFormVerify())
        {
            if ($this->request->postExists('validate'))
            {
                if (!empty($this->vars['id'])) {
                    $comment = new Comment(array('id' => $this->vars['id']));
                    $comment->setValidate($this->request->postData('validate', FILTER_SANITIZE_NUMBER_INT));
                    if (!$comment->save()) {
                        $response = new Response();
                        $response->redirect500();
                    }
                }
            }
        }
        $this->listComment();
    }

    public function deleteComment()
    {
        if (!empty($this->vars['id']))
        {
            $comment = new Comment();
            $comment->delete($this->vars['id']);
        }
        $this->listComment();
    }

}

