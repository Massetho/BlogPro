<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 11/01/2018
 * Time: 16:44
 */
namespace App\Block\Form;

class TextField extends Field
{
    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->getErrorMessage())) {
            $widget .= $this->getErrorMessage().'<br />';
        }

        $widget .= '<label>'.$this->getLabel().'</label><textarea name="'.$this->getName().'"';

        if (!empty($this->getCols())) {
            $widget .= ' cols="'.$this->getCols().'"';
        }

        if (!empty($this->getRows())) {
            $widget .= ' rows="'.$this->getRows().'"';
        }
        $widget .= ' />';

        if (!empty($this->getValue())) {
            $widget .= $this->getValue();
        }

        return $widget.'</textarea><div class="clearfix"></div>';
    }
}
