<?php

class Application_Model_Expense extends Me_Model_Abstract
{
    protected $_id;
    protected $_description;
    protected $_categoryId;
    protected $_amount;
    protected $_date;
    protected $_created;
    
    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
        return $this;
    }

    public function getDescription() {
        return $this->_description;
    }

    public function setDescription($description) {
        $this->_description = $description;
        return $this;
    }

    public function getCategoryId() {
        return $this->_categoryId;
    }

    public function setCategoryId($categoryId) {
        $this->_categoryId = $categoryId;
        return $this;
    }

    public function getAmount() {
        return $this->_amount;
    }

    public function setAmount($amount) {
        $this->_amount = $amount;
        return $this;
    }

    public function getDate() {
        return $this->_date;
    }

    public function setDate($date) {
        $this->_date = $date;
        return $this;
    }

    public function getCreated() {
        return $this->_created;
    }

    public function setCreated($created) {
        $this->_created = $created;
        return $this;
    }

    
}

