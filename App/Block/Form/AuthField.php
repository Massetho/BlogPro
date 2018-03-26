<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 15/01/2018
 * Time: 15:44
 */
namespace App\Block\Form;

class AuthField extends Field
{
    public function buildWidget()
    {
        $widget = '';

        $widget .= '<input type="hidden" name="authForm"';

        if (!empty($this->getValue())) {
            $widget .= ' value="'.htmlspecialchars($this->getValue()).'"';
        }

        return $widget .= ' />';
    }
}
