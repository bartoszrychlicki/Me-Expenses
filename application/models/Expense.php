<?php

class Application_Model_Expense extends Me_Model_Abstract
{
    protected $_id;
    protected $_description;
    protected $_categoryId;
    protected $_amount;
    protected $_date;
    protected $_created;
    protected $_category; // it a category model object
    
    public function getId() 
    {
        return $this->_id;
    }

    public function setId($id) 
    {
        $this->_id = $id;
        return $this;
    }

    public function getDescription() 
    {
        return $this->_description;
    }

    public function setDescription($description) 
    {
        $this->_description = $description;
        return $this;
    }

    public function getCategoryId() 
    {
        return $this->_categoryId;
    }

    public function setCategoryId($categoryId) 
    {
        $this->_categoryId = $categoryId;
        return $this;
    }

    public function getAmount() 
    {
        return $this->_amount;
    }

    public function setAmount($amount) 
    {
        $filter = new Zend_Filter_LocalizedToNormalized();
        $amount = $filter->filter($amount);
        $this->_amount = $amount;
        return $this;
    }

    public function getDate() 
    {
        return $this->_date;
    }

    public function setDate($date) 
    {
        $this->_date = $date;
        return $this;
    }

    public function getCreated() 
    {
        return $this->_created;
    }

    public function setCreated($created) 
    {
        $this->_created = $created;
        return $this;
    }
    
    public function getCategory()
    {
        return $this->_category;
    }
    
    public function setCategory(Application_Model_Category $category)
    {
        $this->_category = $category;
        return $this;
    }
    
    public function getAmountAsCurrency()
    {
  
        $currency = new Zend_Currency(
            array(
                'value'     => $this->getAmount(),
                'locale'    => 'pl_PL'
            )
        );
        return $currency;        
    }

    
}

