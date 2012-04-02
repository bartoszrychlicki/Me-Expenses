<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{

    protected $_name = 'category';

    protected $_dependentTables = array('Application_Model_DbTable_Expense');
}

