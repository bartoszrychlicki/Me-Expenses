<?php

class Application_Form_Category extends Twitter_Form
{

    public function init()
    {
        $this->setName('category');
        $this->setAttrib("inline", true);


        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name');
        $this->addElement($name);
 
        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('Description');
        $this->addElement($description);
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Dodaj');
        $this->addElement($submit);
    }


}

