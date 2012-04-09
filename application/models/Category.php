<?php

class Application_Model_Category extends Me_Model_Abstract
{
    protected $_id;
    protected $_name;
    protected $_description;
    protected $_isSystemic;
    protected $_created;
    
    public function getCreated() 
    {
        return $this->_created;
    }

    public function setCreated($created) 
    {
        $this->_created = $created;
        return $this;
    }

    public function getIsSystemic() 
    {
        return $this->_isSystemic;
    }

    public function setIsSystemic($isSystemic) 
    {
        $this->_isSystemic = (bool) $isSystemic;
        return $this;
    }
    
    public function setDescription($description) 
    {
        $this->_description = $description;
        return $this;
    }
    
    public function getDescription()
    {
        return $this->_description;
    }
 
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
    
    public function isSystemic() 
    {
        if ($this->_isSystemic == true or $this->_isSystemic == 1) {
            return true;
        } else {
            return false;
        }
    }
}

