<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    public function testIndexAction()
    {
        $this->dispatch("/");
        
        // assertions
        $this->assertNotController('error');
        $this->assertModule('default');
        $this->assertController('index');
        $this->assertAction('index');
    }
    
    public function testSaveCategoryAction()
    {
        $this->dispatch('/index/save-category');
        
        // assertions
        $this->assertQuery('form');
        $this->assertNotController('error');
        $this->assertModule('default');
        $this->assertController('index');
        $this->assertAction('save-category');
    }
    
    public function testIfDeleteCategoryWorks()
    {
        // first creating new cateogry
        $data = array(
            'name'  => 'testCat',
            'isSystemic' => 1,
            );
        $model = new Application_Model_Category($data);
        $id = $model->getMapper()->save($model)->id; // we have new category saved
        $this->dispatch('/index/save-category');

        
        $this->assertNotController('error');
        
        $this->resetRequest()
                     ->resetResponse();
                     
        $this->request->setMethod('post')->
            setPost(array(
                'id' => $id,
                ));
        $this->dispatch('/index/delete-category');
        
        // assertions
        $this->assertNotController('error');
    }
    
    public function testIfICanSaveNewCategory()
    {
        $this->request->setMethod('post')->
            setPost(array(
                'name' => 'TestCat',
                'description' => '',
                'isSystemic' => 0,
                ));
        $this->dispatch('/index/save-category');
        
        $this->assertRedirectTo('/');
        
        $this->resetRequest()
                     ->resetResponse();

        $this->request->setMethod('GET')
             ->setPost(array());
        $this->dispatch('/');
        $this->assertModule('default');
        $this->assertController('index');
        $this->assertAction('index');
        $this->assertNotRedirect();
        $this->assertQueryContentContains('a', 'TestCat');
    }

}

