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
        
        $request = $this->getRequest();
        if($request->isPost()) {
            $post = $request->getPost();
            if($form->isValid($post)) {
                $data = array(
                    'name' => $post['name']
                );
                $model = new Application_Model_Category($data);
                $categoryMapper = new Application_Model_CategoryMapper();
                $categoryMapper->save($model);
                $this->_helper->FlashMessenger(array('success' => 'New category added'));
                $this->_helper->Redirector('index', 'index');
            }
        }
    }
    


}

