<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
     //rebuidling tests to use the builder instead of domain class.
    public function testUsersEmptyArgumentsException()
    {
        // arrange
        $actual = null;
        $expected = "empty arguments";
        $harness = new \App\Domain\UserBuilder();
        // act
        try {
            $harness->setEmail('');

        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        // assert
        $this->assertEquals($expected, $actual);
    }

    public function testUsersNotStringsException()
    {
        // arrange
        $actual = null;
        $expected = "arguments are not strings";
        $harness = new \App\Domain\UserBuilder();
        // act
        try {
            $harness->setEmail(1);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        // assert
        $this->assertEquals($expected, $actual);
    }

    public function testEmailNotValidException()
    {
        // arrange
        $actual = null;
        $expected = "email is not valid";
        $harness = new \App\Domain\UserBuilder();
        // act
        try {
            $harness->setEmail("someString");
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        // assert
        $this->assertEquals($expected, $actual);
    }

    public function testEmailSetting()
    {
        //arrange
        $expect = "anna@example.test";
        $actual = null;
        // Act
        $u = new \App\Domain\User("anna@example.test", "Anna Able");
        $actual = $u->getEmail();
        //Assert
        $this->assertEquals($expect, $actual);
    }

    public function testNameSetting()
    {
        //Arrange
        $expect = "Anna Able";
        $actual = null;

        //act
        $u = new \App\Domain\User("anna@example.test", 'Anna Able');
        $actual = $u->getFullname();
        //assert
        $this->assertEquals($expect, $actual);
    }

}
