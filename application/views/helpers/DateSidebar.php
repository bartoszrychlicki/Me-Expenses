<?php
class Application_View_Helper_DateSidebar extends Zend_View_Helper_Abstract {
    
    public $view;
    
    public function dateSidebar()
    {
        $categoryMapper = new Application_Model_MonthMapper();
        $currentMonth   = $categoryMapper->create(time());
        $previousMonth  = $categoryMapper->create(strtotime("-1 month"));
        
        $months = array(
          $currentMonth,
          $previousMonth
        );
        $output = $this->view->partial('_dateSidebar.phtml', array('months' => $months));
        return $output;
    }
    
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
}
?>
