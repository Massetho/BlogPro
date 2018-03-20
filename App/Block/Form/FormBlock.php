<?php
/**
 * @description: Abstract class for Forms
 * @author: Quentin Thomasset
 * @package: BlogPro
 * Date: 10/01/2018
 * Time: 14:20
 */
namespace App\Block\Form;
use App\Block\BlockAbstract;
use App\Model\Call;

abstract class FormBlock extends BlockAbstract
{
    protected $view = __DIR__ . '/../../View/Template/ViewForm.php'; //path to template
    protected $form;
    protected $block = 'form';
    protected $fields = [];
    protected $entity;
    protected $uniqid;
    protected $message;

    /**
     * FormBlock constructor.
     * @param $controller
     * @param object $entity
     */
    public function __construct($controller, $entity = NULL)
    {
        parent::__construct($controller, $entity);
        $this->uniqid = uniqid();
        $_SESSION['authForm'] = $this->uniqid;
        $this->build();
    }

    public function addField($field)
    {
        $attr = 'get' . ucfirst($field->getName()); // We retrieve the field's name

        if (!is_null($this->entity) && !empty($this->entity->$attr()))
        {
            $field->setValue($this->entity->$attr()); // We set the field's value if there is one
        }

        $this->fields[] = $field; // We add field object in the fields collection
        return $this;
    }

    public function createView()
    {
        $view = '';

        // Each field is added to the view.
        foreach ($this->fields as $field)
        {
            $view .= $field->buildWidget().'<br />';
        }

        return $view;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($msg)
    {
        if(is_string($msg)) {
            $this->message = $msg;
            return true;
        }
        else
            return false;
    }

    abstract public function build();

}
