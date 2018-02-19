<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 11/01/2018
 * Time: 15:48
 */
namespace App\Block\Form;


class StringField extends Field
{

    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->getErrorMessage()))
        {
            $widget .= $this->getErrorMessage().'<br />';
        }

        $widget .= '<label>'.$this->getLabel().'</label><input type="text" name="'.$this->getName().'"';

        if (!empty($this->getValue()))
        {
            $widget .= ' value="'.htmlspecialchars($this->getValue()).'"';
        }

        if (!empty($this->getMaxLength()))
        {
            $widget .= ' maxlength="'.$this->getMaxLength().'"';
        }

        if (!empty($this->getOnblur()))
        {
            $widget .= ' onblur="'.$this->getOnblur().'"';
        }

        return $widget .= ' />';
    }

}