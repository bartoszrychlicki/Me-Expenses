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

}

