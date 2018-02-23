<?php
/**
 * @description: Page class
 * @author: Quentin Thomasset
 * @package: BlogPro
 * Date: 11/11/2017
 * Time: 12:34
 */
namespace App\Model;

class Page
{

    protected $layout = __DIR__ . '/../View/Layout/layout.php';
    protected $blocks = [];

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

    /**
     * @return string view
     */
    public function render()
    {
        $renderViews = [];
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