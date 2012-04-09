<?php

class Application_Model_ExpenseMapper extends Me_Model_Mapper_Abstract
{
    protected $_dbTable = 'Application_Model_DbTable_Expense';

    public function save(Application_Model_Expense $model)
    {
        $log = Zend_Registry::get('log');
        //we exploding the data to get timestamp for date
        $arr = explode('/',$model->getDate());
        
        $log->debug($arr);

        $date = mktime(0,0,1, $arr[1], $arr[0], $arr[2]);
        $data = array(
            'description'   => $model->getDescription(),
            'amount'        => $model->getAmount(),
            'category_id'   => $model->getCategoryId(),
            'date'          => $date,
            'created'       => time(),
        );
 
        if (null === ($id = $model->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    
    public function delete(Application_Model_Expense $model)
    {
        $this->getDbTable()->delete(array('id = ?' => $model->getId()));
    }
     
    public function find($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $entry = $this->_createNewModelFromRow($row);
        return $entry;
    }
 
    public function fetchAll()
    {
        $select    = $this->getDbTable()->select();
        $select->order('date DESC');
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = $this->_createNewModelFromRow($row);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function fetchAllForMonth($timestamp)
    {
        $resultSet = $this->getDbTable()->fetchAllForMonth($timestamp);
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = $this->_createNewModelFromRow($row);
            $entries[] = $entry;
        
        }
        return $entries;
    }    
    
    protected function _createNewModelFromRow(Zend_Db_Table_Row $row)
    {
        $entry = new Application_Model_Expense($row->toArray());
        $category = $row->findParentApplication_Model_DbTable_Category();
        if($category) {
            $categoryModel = new Application_Model_Category($category->toArray());
            $entry->setCategory($categoryModel);
        }
        return $entry;
    }
    
}

