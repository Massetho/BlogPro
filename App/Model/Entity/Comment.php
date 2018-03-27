<?php
/**
 * @description :
 * @package : PhpStorm.
 * @Author : quent
 * @date: 20/03/2018
 * @time: 16:16
 */

namespace App\Model\Entity;

class Comment extends AbstractEntity
{
    public function getComments($idArticle)
    {
        $comments = [];
        $datas = $this->getColumn('comment_article', $idArticle, 'validate', 1);
        foreach ($datas as $data)
        {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    public function getChildren()
    {
        $comments = [];
        $datas = $this->getColumn('id_parent', $this->getId_comment());
        foreach ($datas as $data)
        {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    public function getAuthor()
    {
        $admin = new Admin(array('id' => $this->getComment_admin()));
        return $admin->getFirstname();
    }
}