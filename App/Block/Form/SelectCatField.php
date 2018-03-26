<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 15/01/2018
 * Time: 18:38
 */
namespace App\Block\Form;

use App\Model\Entity\Category;

class SelectCatField extends Field
{
    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->getErrorMessage())) {
            $widget .= $this->getErrorMessage().'<br />';
        }

        $widget .= '<label >'.$this->getLabel().'</label><select name="'.$this->getName().'">';

        $category = new Category();

        //We load all categories
        $options = $category->getCollection();

        //Generate an option for each category
        foreach ($options as $option) {
            //If article already has a category, pre-select it.
            if (!empty($this->getValue()) && ($this->getValue() == $option->getId_category())) {
                $widget .= '<option value="'.$option->getId_category().'" selected>"'.htmlspecialchars($option->getName()).'"</option>';
            } else {
                $widget .= '<option value="'.$option->getId_category().'">"'.htmlspecialchars($option->getName()).'"</option>';
            }
        }

        return $widget .= '</select><div class="clearfix"></div>';
    }
}
