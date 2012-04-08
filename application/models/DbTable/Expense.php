<?php

class Application_Model_DbTable_Expense extends Zend_Db_Table_Abstract
{

    protected $_name = 'expense';
    
    protected $_referenceMap = array(
        'Category' => array(
            'columns' => array('category_id'),
            'refTableClass' => 'Application_Model_DbTable_Category',
            'refColumns' => array('id')
        ),
    );
    
    public function getName()
    {
        return $this->_name;
    }

}

