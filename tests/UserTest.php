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
        $expected = '$email is not a string';
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
        // arrange
        $actual = null;
        $expected = "anne@example.com";
        $harness = new \App\Domain\UserBuilder();
        // act
        try {
            $harness->setEmail("anne@example.com");
        } catch (\Exception $e) {
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        //Assert
        $actual = $harness->getEmail();
        $this->assertEquals($expected, $actual);
    }

    public function testFirstnameEmptyArgumentsException()
    {
        // arrange
        $actual = null;
        $expected = '$firstname is empty';
        $harness = new \App\Domain\UserBuilder();
        // act
        try {
            $harness->setFirstname('');

        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        // assert
        $this->assertEquals($expected, $actual);
    }

    public function testFirstnameNotStringsException()
    {
        // arrange
        $actual = null;
        $expected = '$firstname is not a string';
        $harness = new \App\Domain\UserBuilder();
        // act
        try {
            $harness->setFirstname(1);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        // assert
        $this->assertEquals($expected, $actual);
    }

    public function testFirstnameSetting()
    {
        //Arrange
        $expect = "Anna";
        $actual = null;

        //act
        $harness = new \App\Domain\UserBuilder();
        $harness->setFirstname('Anna');
        $actual = $harness->getFirstname();
        //assert
        $this->assertEquals($expect, $actual);
    }

    public function testLastnameEmptyArgumentsException()
    {
        // arrange
        $actual = null;
        $expected = '$lastname is empty';
        $harness = new \App\Domain\UserBuilder();
        // act
        try {
            $harness->setLastname('');

        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        // assert
        $this->assertEquals($expected, $actual);
    }

    public function testLastnameNotStringsException()
    {
        // arrange
        $actual = null;
        $expected = '$lastname is not a string';
        $harness = new \App\Domain\UserBuilder();
        // act
        try {
            $harness->setLastname(1);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        // assert
        $this->assertEquals($expected, $actual);
    }

    public function testLastnameSetting()
    {
        //Arrange
        $expect = "bell";
        $actual = null;

        //act
        $harness = new \App\Domain\UserBuilder();
        $harness->setLastname("bell");
        $actual = $harness->getLastname();
        //assert
        $this->assertEquals($expect, $actual);
    }

    public function testbuild() {
        //Arrange
        $expect = \App\Domain\User::class;
        $harness = new \App\Domain\UserBuilder();

        $actual = $harness->build();

        $this->assertEquals($expect, get_class($actual));

    }

}
