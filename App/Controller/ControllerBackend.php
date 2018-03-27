<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 20/12/2017
 * Time: 13:44
 */

namespace App\Controller;

use App\Model\Entity\Article;
use App\Model\Response;
use App\Block\BackListArticleBlock;
use App\Block\BackHeaderBlock;
use App\Model\Entity\Admin;

class ControllerBackend extends ControllerAbstract
{
    public function __construct($router, $request, $vars)
    {
        parent::__construct($router, $request, $vars);
        $this->checkAdmin();
    }

    public function checkAdmin()
    {
        //if (Admin::isAuthenticated() !== _AUTH_ADMIN_)
        $adm =Admin::isAuthenticated();
        if ($adm != _AUTH_ADMIN_) {
            $response = new Response();
            $response->redirect('https://blogpro.test/admin');
        }
    }

    public function listArticle()
    {
        $page = $this->page;
        $page->setLayout(__DIR__ . '/../View/Layout/backLayout.php');
        $page->addBlock(new BackListArticleBlock($this));
        $page->addBlock(new BackHeaderBlock($this));
        $response = new Response();
        $response->setBody($page->render())->send();
    }

    public function deleteArticle()
    {
        if (!empty($this->vars['id'])) {
            $article = new Article();
            $article->delete($this->vars['id']);
        }
        $this->listArticle();
    }

    public function sessionDestroy()
    {
        session_destroy();
        $response = new Response();
        $response->redirect('https://blogpro.test');
    }

    public function uploadImage(
        $folder = '',
                         $index = 'image',
                         $destination = _IMG_FILE_,
                         $maxsize = 1048576,
                         $extensions = array('jpg', 'jpeg', 'png')
    ) {
        //Test1: file exist ?
        if (!isset($_FILES[$index]) or $_FILES[$index]['error'] > 0) {
            return false;
        }
        //Test2: under max size ?
        if ($maxsize !== false and $_FILES[$index]['size'] > $maxsize) {
            return false;
        }
        //Test3: good extension ?
        $ext = substr(strrchr($_FILES[$index]['name'], '.'), 1);
        if ($extensions !== false and !in_array($ext, $extensions)) {
            return false;
        }
        //Test4: is image ?
        if (exif_imagetype($_FILES[$index]['tmp_name']) === false) {
            return false;
        }

        //Directory management
        $cwd = getcwd();
        $imagefile = $cwd.$destination.$folder;
        $thumbfile = $imagefile.'/thumbnail/';
        if (!file_exists($thumbfile)) {
            mkdir($thumbfile, 0755, true);
        }

        $filename = $imagefile.'/'.$_FILES[$index]['name'];
        if (move_uploaded_file($_FILES[$index]['tmp_name'], $filename) === false) {
            return false;
        }
        //Thumbnail
        $filenameThumb = $thumbfile.$_FILES[$index]['name'];
        return $this->imagethumb($filename, $filenameThumb, 560);
    }
}
