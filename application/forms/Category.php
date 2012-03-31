<?php

class Application_Form_Category extends Zend_Form
{

    public function init()
    {
        $this->setName('category');
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Nazwa');
        $this->addElement($name);
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Dodaj');
        $this->addElement($submit);
    }


}

