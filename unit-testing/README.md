Unit Testing
============


What is it and why do I want to use it?
-----------

Unit testing is a way of testing individual "units" of source code to verify that they work correctly. It is common to
view a "unit" as the smallest testable part of an application, usually a function. Essentially you are writing tests
in programming code to verify that your functions and classes work as expected.

The reasons to use unit testing can be broken down into the following:

 * It helps you find errors and problems early.
 * It helps speed up refactoring and change as you can test that your program is still behaving the way it is expected
   to after the changes have been made.
 * It serves as a very good method of documentation for your project. Other programmers can get a really good idea of
   how your code is meant to work and can get peace of mind that it is working as expected.
 * Most importantly, it forces you to think about how your code should work before you dive in and start creating new
   classes and modules.

How to install it?
-----------

The preferred testing tool in PHP is [PHPUnit](http://www.phpunit.de/manual/current/en/). There are a number of ways to
install it but by far the best way is using [Composer](http://getcomposer.org/). I am going to assume you are
comfortable with installing composer yourself.

Create your composer.json file in the root of your project with the following content:

    {
        "require": {
            "phpunit/phpunit": "3.7.*"
        }
    }

Now install your dependencies using the composer tool

    php-zero-to-hero/unit-testing$ php composer.phar install

You should see output like this:

    Loading composer repositories with package information
    Installing dependencies
      - Installing symfony/yaml (v2.1.6)
        Downloading: 100%

      - Installing phpunit/php-text-template (1.1.4)
        Downloading: 100%

      - Installing phpunit/phpunit-mock-objects (1.2.2)
        Downloading: 100%

      - Installing phpunit/php-timer (1.0.4)
        Downloading: 100%

      - Installing phpunit/php-token-stream (1.1.5)
        Downloading: 100%

      - Installing phpunit/php-file-iterator (1.3.3)
        Downloading: 100%

      - Installing phpunit/php-code-coverage (1.2.7)
        Downloading: 100%

      - Installing phpunit/phpunit (3.7.10)
        Downloading: 100%

    phpunit/php-code-coverage suggests installing ext-xdebug (>=2.0.5)
    phpunit/phpunit suggests installing phpunit/php-invoker (>=1.1.0)
    Writing lock file
    Generating autoload files

Test that you have installed it correctly by running the following command:

    php-zero-to-hero/unit-testing$ vendor/bin/phpunit --version
    PHPUnit 3.7.10 by Sebastian Bergmann.


Your first phpunit test
-----------

Note: The source code for this example is in unit-testing/01-first-test

For this demo there are two files:

 * Mathematics.php : The actual class you want to test
 * MathematicsTest.php : The test code for the Mathematics class

### Mathematics.php

This file contails the actual class you are trying to test. You can see that there is a single function in the class
named "add" which takes two numbers and returns the result of adding the two numbers together

    class Mathematics
    {
        public function add($firstNumber, $secondNumber) {
            return $firstNumber + $secondNumber;
        }
    }

### MathematicsTest.php

This file contains the test code for the Mathematics class. You can see that the class extends from the
PHPUnit_Framework_TestCase class which provides all the unit testing features you need.

There is a function in here called "testAddOneAndTwoEqualsThree" which simply creates an instance of the
Mathematics class, calls it's add function and uses an assertion to check that the result returned by the class is
correct.

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

    }

### Running the Test

You can now use the phpunit binary that you installed earlier to run the test to ensure that the function works
correctly.

    php-zero-to-hero/unit-testing$ vendor/bin/phpunit 01-first-test/MathematicsTest.php
    PHPUnit 3.7.10 by Sebastian Bergmann.

    .

    Time: 0 seconds, Memory: 2.25Mb

    OK (1 test, 1 assertion)

### More Tests

Now that we have a functioning test we can see what happens when we really think about what this simple "add" function
should do.

Take a look at the extra two test functions which are commented out in MathematicsTest.php, you can see they are both
checking that the add function returns appropriate errors when invalid arguments are passed in. Uncomment them.

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithInvalidNumbersThrowsAnException() {
        $maths = new Mathematics();
        $maths->add('a','b');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithNullsThrowsAnException() {
        $maths = new Mathematics();
        $maths->add(null, null);
    }

Now Re-Run the tests:

    php-zero-to-hero/unit-testing$ vendor/bin/phpunit 01-first-test/MathematicsTest.php
    PHPUnit 3.7.10 by Sebastian Bergmann.

    .FF

    Time: 0 seconds, Memory: 2.50Mb

    There were 2 failures:

    1) MathematicsTest::testAddWithInvalidNumbersThrowsAnException
    Failed asserting that exception of type "\InvalidArgumentException" is thrown.


    2) MathematicsTest::testAddWithNullsThrowsAnException
    Failed asserting that exception of type "\InvalidArgumentException" is thrown.


    FAILURES!
    Tests: 3, Assertions: 3, Failures: 2.

Oops, our simple class isn't working correctly! Think about how you would fix the add function to pass these tests now.
