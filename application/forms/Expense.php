<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Expense
 *
 * @author Bard
 */
class Application_Form_Expense extends Twitter_Form {

    public function init()
    {
        
        $this->setName('expense');
        $this->setAttrib("horizontal", true);
        $this->setMethod('post');

        $name = new Zend_Form_Element_Text('amount');
        $name->setLabel('Amount');
        $this->addElement($name);
 
        $category = new Zend_Form_Element_Select('category_id');
        $category->setLabel('Category');
        // fetching categories from DB
        $categoryMapper = new Application_Model_CategoryMapper;
        foreach($categoryMapper->fetchAll() as $cat) {
            $category->addMultiOption($cat->id, $cat->name);
        }
        $this->addElement($category);
        
        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('Optional description');
        $this->addElement($description);
        
        $date = new Zend_Form_Element_Text('date');
        $date->setLabel('Date of the expense');
        $date->setValue(time());
        $this->addElement($date);
        
        $submit = new Zend_Form_Element_Submit('Save');
        $submit->setLabel('Zapisz');
        
        $this->addElement($submit);
    }

}

?>
