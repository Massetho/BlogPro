<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 11/11/2017
 * Time: 12:34
 */
namespace App\Model;

class Page
{

    protected $views =[];
    protected $globals =[];
    protected $layout = __DIR__ . '/../View/Layout/layout.php';
    protected $blocks = [];

    public function addView($key, $path, $params)
    {
        $this->views[$key] =  array('path' =>$path, 'params' => $params);
        return $this;
    }

    public function addGlobal($key, $value)
    {
        $this->globals[$key] = $value;
        return $this;
    }

    public function addBlock($block)
    {
            $this->blocks[] = $block;
            return $this;
    }

    public function setLayout($path)
    {
        $this->layout = $path;
        return $this;
    }

    public function render()
    {
        $renderViews = [];
        extract($this->globals);
        foreach ($this->blocks as $block)
        {
            $renderViews[$block->getBlock()] = $block->render();
        }
        ob_start();
        extract($renderViews);
        require_once ($this->layout);
        return ob_get_clean();
    }
}