<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategorySidebar
 *
 * @author Bard
 */
class Application_View_Helper_CategorySidebar extends Zend_View_Helper_Abstract {
    
    public $view;
    
    public function categorySidebar()
    {
        $categoryMapper = new Application_Model_CategoryMapper();
        $categories = $categoryMapper->fetchAll();
        $output = $this->view->partial('_categorySidebar.phtml', array('categories' => $categories));
        return $output;
    }
    
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
}

?>
