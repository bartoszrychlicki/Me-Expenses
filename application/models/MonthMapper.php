<?php

class Application_Model_MonthMapper
{
    protected $_dbTable = null;

    public function create($timestamp) {
        $data = array(
            'timestamp'     => $timestamp,
            'monthNumber'   => date('m', $timestamp),
            'year'          => date('Y', $timestamp),
            );
        $month = new Application_Model_Month($data);
        //fetching expenses
        $expenseMapper = new Application_Model_ExpenseMapper();
        $expenses = $expenseMapper->fetchAllForMonth($timestamp);
        $month->setExpenses($expenses);
        $sum = 0;
        foreach($expenses as $expense) {
            $sum = $sum + $expense->amount;
        }
        $month->setExpensesSum($sum);

        return $month;
    }
}

