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
                $model = new Application_Model_Category($post);
                $categoryMapper = new Application_Model_CategoryMapper();
                $categoryMapper->save($model);
                $this->_helper->FlashMessenger(array('success' => 'New category added'));
                $this->_helper->Redirector('index', 'index');
            }
        }
    }
    
    public function deleteCategoryAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $mapper = new Application_Model_CategoryMapper();
        $model = $mapper->find($id);
        $mapper->delete($model);
        
    }
}

