<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 03/10/2017
 * Time: 17:28
 */
namespace App\Controller;
use App\Model\Entity\Article;
use App\Model\Page;
use App\Model\Response;

// TODO : Changer le nom de Home en portolio, ajouter le chapeau aux articles.
class ControllerHome extends ControllerAbstract {

    public function index()
    {
        $page = $this->page;

        //Creating blocks
        array_map(function($block) use($page){
            $className = 'App\\Block\\'.ucfirst($block) . 'Block';
            $page->addBlock(new $className($this));
        }, ['header', 'footer', 'article']);

        $response = new Response();
        echo $response->setBody($page->render())->send();
    }

    public function tables()
    {
        $table = '<table>';
        $items = json_decode(file_get_contents(__DIR__ . '/../Content/list.json'));
        foreach ($items as $key => $value)
        {
           $table.= '<tr>';
           $table.= '<td>'.$key.'</td>';
           $table.= '<td>'.$value.'</td>';
           $table.= '</tr>';
        }
        $table.='</table>';
        return $table;
    }
}
