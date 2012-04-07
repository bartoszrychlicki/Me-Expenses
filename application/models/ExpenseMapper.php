<?php

class Application_Model_ExpenseMapper extends Me_Model_Mapper_Abstract
{
    protected $_dbTable = 'Application_Model_DbTable_Expense';

    public function save(Application_Model_Expense $model)
    {
        $data = array(
            'description'   => $model->getDescription(),
            'amount'        => $model->getAmount(),
            'category_id'   => $model->getCategoryId(),
            'date'          => $model->getDate(),
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
        $entry = new Application_Model_Expense($row->toArray());
        return $entry;
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Expense($row->toArray());
            $entries[] = $entry;
        }
        return $entries;
    }
}

