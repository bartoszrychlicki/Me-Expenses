<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    /**
     * Adding new Expenses
     */
    public function indexAction()
    {
        $form = new Application_Form_Expense();
        $this->view->form = $form;
        
        $this->view->headTitle('Dashboard');
    }
    
    public function ajaxAction()
    {
        $request = $this->getRequest();
    }
    
    public function saveCategoryAction()
    {
        $form = new Application_Form_Category();
        $this->view->form = $form;
        $categoryMapper = new Application_Model_CategoryMapper();

        $request = $this->getRequest();

        $log = Zend_Registry::get('log');
        if ($request->isXmlHttpRequest()) {
            $log->debug('is ajax');
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout->disableLayout();
        }
        if ($request->isPost()) {
            $post = $request->getPost();
            if ($form->isValid($post)) {
                $log->debug($post);
                $model = new Application_Model_Category($post);
                $categoryMapper->save($model);
                if ($request->isXmlHttpRequest()) {
                    echo $model->getName();
                } else {
                    $this->_helper->FlashMessenger(array('success' => 'New category added'));
                    $this->_helper->Redirector('index', 'index');
                }
            }
        }

        // fetching all categories
        $this->view->categories = $categoryMapper->fetchAll();
        
        // head title
        $this->view->headTitle('Category management');
        
        // jeditable jquery plugin
        $this->view->headScript()->appendFile('/js/jquery.jeditable.mini.js');
    }
    
    public function deleteCategoryAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $mapper = new Application_Model_CategoryMapper();
        $model = $mapper->find($id);
        $mapper->delete($model);
        
    }
}