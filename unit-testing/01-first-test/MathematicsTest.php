<?php
require_once dirname(__FILE__).'/Mathematics.php';
require_once dirname(__FILE__).'/../vendor/autoload.php';

/**
 * Test Class for Mathematics
 */
class MathematicsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that when you add One and Two you get the answer Three
     * @test
     */
    public function testAddOneAndTwoEqualsThree() {
        $maths = new Mathematics();
        $result = $maths->add(1,2);
        $this->assertEquals(3, $result, "One plus Two should equal 3");
    }

    /* Uncomment these tests to see some failing tests */
//    /**
//     * @test
//     * @expectedException \InvalidArgumentException
//     */
//    public function testAddWithInvalidNumbersThrowsAnException() {
//        $maths = new Mathematics();
//        $maths->add('a','b');
//    }
//
//    /**
//     * @test
//     * @expectedException \InvalidArgumentException
//     */
//    public function testAddWithNullsThrowsAnException() {
//        $maths = new Mathematics();
//        $maths->add(null, null);
//    }

}
