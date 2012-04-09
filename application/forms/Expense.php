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
class Application_Form_Expense extends Twitter_Form
{
    public function init()
    {
        
        $this->setName('expense');
        $this->setAttrib("horizontal", true);
        $this->setMethod('post');

        $amount = new Zend_Form_Element_Text('amount');
        $amount->setLabel('Amount');
        $amount->setRequired(true);
        $amount->addFilter('StripTags');        
        $floatValidator = new Zend_Validate_Float('pl_PL'); 
        $amount->addValidator($floatValidator); 
        $this->addElement($amount);

 
        $category = new Zend_Form_Element_Select('category_id');
        $category->setLabel('Category');
        $category->setRequired(true);
        // fetching categories from DB
        $categoryMapper = new Application_Model_CategoryMapper;
        foreach ($categoryMapper->fetchAll() as $cat) {
            $category->addMultiOption($cat->id, $cat->name);
        }
        $this->addElement($category);
        
        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('Optional description');
        $description->addFilter('StripTags');
        $this->addElement($description);
        
        $date = new Zend_Form_Element_Text('date');
        $date->setLabel('Date of the expense');
        $date->setRequired(true);
        $date->addValidators(
            array(
                array('Date', array('format' => 'dd/mm/yyyy', 'locale' => 'pl')),
            )
        );
        
        $date->setAttrib('class', 'datepicker');
        $date->setValue(date("d/m/Y"));
        $this->addElement($date);
        
        $submit = new Zend_Form_Element_Submit('Save');
        $submit->setLabel('Zapisz');
        
        $this->addElement($submit);
    }

}