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
        $log = Zend_Registry::get('log');
        
        $mapper = new Application_Model_MonthMapper();
        
        $month = $mapper->create(time()); // creating new month model for current month
        
        $log->debug($month);
        $this->view->month = $month;
        
        $form = new Application_Form_Expense();
        $this->view->form = $form;
        
        // saveing new expense in DB
        $request = $this->getRequest();
        if($request->isPost()) {
            $post = $request->getPost();
            if($form->isValid($post)) {
                $model = new Application_Model_Expense($post);
                $model->setCategoryId($post['category_id']);
                $expenseMapper = new Application_Model_ExpenseMapper();
                $expenseMapper->save($model);
                $this->_helper->FlashMessenger(array('success' => 'New expense added'));
                $this->_helper->Redirector('index', 'index');
            }
        }
        
        $this->view->headTitle('Dashboard');
    }
    
    public function saveCategoryAction()
    {
        $form = new Application_Form_Category();
        $this->view->form = $form;
        $categoryMapper = new Application_Model_CategoryMapper();

        $request = $this->getRequest();

        $log = Zend_Registry::get('log');
        if ($request->isXmlHttpRequest()) {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->layout->disableLayout();
        }
        if ($request->isPost()) {
            $post = $request->getPost();
            if ($form->isValid($post)) {
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
    
    public function deleteCategoryAction() 
    {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $mapper = new Application_Model_CategoryMapper();
        $model = $mapper->find($id);
        $mapper->delete($model);
        $this->_helper->FlashMessenger(array('success' => 'The category has been deleted'));
        $this->_helper->Redirector('index', 'index');
    }
    
    public function deleteExpenseAction()
    {
        $request = $this->getRequest();
        if($request->isPost()) {
            $id = $request->getParam('id');
            $mapper = new Application_Model_ExpenseMapper;
            if(is_array($id)) {
                foreach($id as $key => $value) {
                    $model = $mapper->find($value);
                    $mapper->delete($model);
                }
            }
            $this->_helper->FlashMessenger(array('success' => 'The expense has been deleted'));
        }
        $this->_helper->Redirector('index', 'index');
    }
}