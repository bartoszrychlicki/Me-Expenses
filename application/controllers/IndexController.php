<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $categoryMapper = new Application_Model_CategoryMapper();
        $this->view->categories = $categoryMapper->fetchAll();
    }
    
    public function addCategoryAction()
    {
        $form = new Application_Form_Category();
        $this->view->form = $form;
    }
    


}

