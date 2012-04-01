<?php

class Application_Model_CategoryMapper extends Me_Model_Mapper_Abstract
{
    protected $_dbTable = 'Application_Model_DbTable_Category';
    
    public function save(Application_Model_Category $category)
    {
        $data = array(
            'name'   => $category->getName(),
            'description' => $category->getDescription(),
            'is_systemic' => $category->getIsSystemic(),
        );
 
        if (null === ($id = $category->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    
    public function delete(Application_Model_Category $category)
    {
        $this->getDbTable()->delete(array('id = ?' => $category->getId()));
    }
 
    public function find($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $entry = new Application_Model_Category($row->toArray());
        return $entry;
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Category($row->toArray());
            $entries[] = $entry;
        }
        return $entries;
    }

}

