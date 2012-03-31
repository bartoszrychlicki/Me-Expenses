<?php

class Application_Model_CategoryMapper extends Me_Model_Mapper
{
    protected $_dbTable = 'Application_Model_DbTable_Category';
    
    public function save(Application_Model_Category $category)
    {
        $data = array(
            'name'   => $category->getName(),
        );
 
        if (null === ($id = $guestbook->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id, Application_Model_Category $guestbook)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $guestbook->setId($row->id)
                  ->setName($row->name);
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Category();
            $entry->setId($row->id)
                  ->setName($row->name);
            $entries[] = $entry;
        }
        return $entries;
    }

}

