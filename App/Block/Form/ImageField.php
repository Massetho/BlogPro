<?php
/**
 * @description :
 * @package : PhpStorm.
 * @Author : quent
 * @date: 30/01/2018
 * @time: 15:26
 */
namespace App\Block\Form;


class ImageField extends Field
{

    public function buildWidget()
    {
        $widget = '';
        //TODO : add a image field in Article; add a "uploadImage" function to controller; add a "getThumnail" function to article

        if (!empty($this->getErrorMessage()))
        {
            $widget .= $this->getErrorMessage().'<br />';
        }

        $widget .= '<label>'.$this->getLabel().'</label><input type="file" name="'.$this->getName().'"';

        if (!empty($this->getValue()))
        {
            $widget .= ' value="'.htmlspecialchars($this->getValue()).'"';
        }

        return $widget .= ' />';
    }

}