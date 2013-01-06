<?php
require_once dirname(__FILE__).'/../vendor/autoload.php';

/**
 * A test class to demonstrate unit testing
 */
class Mathematics
{
    /**
     * Add two numbers together and return the value
     *
     * @param integer $firstNumber
     * @param integer $secondNumber
     * @return integer
     */
    public function add($firstNumber, $secondNumber) {
        return $firstNumber + $secondNumber;
    }
}
