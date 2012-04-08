<?php

class Application_Model_Month extends Me_Model_Abstract
{
    protected $_monthNumber;
    protected $_year;
    protected $_expenses = array();
    protected $_timestamp;
    protected $_expensesSum;
    
    public function getTimestamp()
    {
        return $this->_timestamp;
    }
    
    public function setTimestamp($timestamp)
    {
        $this->_timestamp = (int) $timestamp;
        return $this;
    }
    
    public function setMonthNumber($monthNumber) 
    {
        $this->_monthNumber = $monthNumber;
        return $this;
    }
    
    public function getMonthNumber()
    {
        return $this->_monthNumber;
    }
    
    public function setYear($year)
    {
        $this->_year = (int) $year;
        return $this;
    }
    
    public function getYear()
    {
        return $this->_year;
    }
    
    public function setExpenses(Array $expenses)
    {
        $this->_expenses = $expenses;
    }
    
    public function getExpenses()
    {
        return $this->_expenses;
    }
    
    public function setExpensesSum($sum) 
    {
        $this->_expensesSum = (float) $sum;
    }
    
    public function getExpensesSumAsCurrency()
    {
        $currency = new Zend_Currency(
            array(
                'value' => $this->_expensesSum,
            )
        );
        return $currency;
    }
}