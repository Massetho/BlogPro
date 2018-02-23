<?php
/**
 * @description : Password Field for forms
 * @package : BlogPro
 * @Author : Quentin Thomasset
 * @date: 23/02/2018
 * @time: 14:49
 */
namespace App\Block\Form;

class PasswordField extends Field
{

    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->getErrorMessage()))
        {
            $widget .= $this->getErrorMessage().'<br />';
        }

        $widget .= '<label>'.$this->getLabel().'</label><input type="password" name="'.$this->getName().'"';

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