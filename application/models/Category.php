<?php

class Application_Model_Category extends Me_model
{
    protected $_id;
    protected $_name;
    
 
    public function setName($name) 
    {
        $this->_name = (string) $name;
        return $this;
    }
    public function getName() 
    {
        return $this->_name;
    }
    
    public function getId() 
    {
        return $this->_id;
    }
    
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
}

