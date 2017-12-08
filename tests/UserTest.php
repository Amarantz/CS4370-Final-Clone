<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ .'/../src/constants.php';

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


    public function testIDFail00() {
        //arrange
        $id = GENERATE_USER_UUID;
        $expected = '$uuid is empty';

        $actual = null;
        $harness = new \App\Domain\UserBuilder();
        try {
            $harness->setID('');
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class,get_class($e));

        }
        $this->assertEquals($expected,$actual);

    }

    public function testIDFail01() {
        //arrange
        $id = GENERATE_USER_UUID;
        $expected = '$uuid is not a string';

        $actual = null;
        $harness = new \App\Domain\UserBuilder();
        try {
            $harness->setID(1);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class,get_class($e));

        }
        $this->assertEquals($expected,$actual);

    }

    public function testIDSuccess() {
        //arrange
        $id = GENERATE_USER_UUID;
        $expected = $id;

        $actual = null;
        $harness = new \App\Domain\UserBuilder();
        try {
            $harness->setID($id);
        } catch (\Exception $e) {
            $this->assertEquals(\InvalidArgumentException::class,get_class($e));

        }
        $actual = $harness->getID();
        $this->assertEquals($expected,$actual);

    }

    public function testFullname() {
        //arrange
        $expect = 'Anna Test';
        $harness = new \App\Domain\UserBuilder();

        //act
        $harness->setFirstname('Anna')->setLastname('Test');

        $this->assertEquals($expect, $harness->getfullname());

    }

    public function testCreatedDateFail00() {
        $date = NOW;
        $expected = '$date is empty';
        $actual = null;
        $harness = new \App\Domain\UserBuilder();

        try{
            $harness->setCreated('');

        } catch (\Exception $e){
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }

        $this->assertEquals($expected, $actual);
    }

    public function testCreatedDateFail01() {
        $date = NOW;
        $expected = '$date is not a string';
        $actual = null;
        $harness = new \App\Domain\UserBuilder();

        try{
            $harness->setCreated(1);

        } catch (\Exception $e){
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }

        $this->assertEquals($expected, $actual);
    }

    public function testCreatedDateSuccess() {
        $date = NOW;
        $expected = NOW;
        $actual = null;
        $harness = new \App\Domain\UserBuilder();

        try{
            $harness->setCreated($date);

        } catch (\Exception $e){
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }

        $this->assertEquals($expected, $harness->getCreated());
    }


    public function testUpdatedDateFail00() {
        $date = NOW;
        $expected = '$date is empty';
        $actual = null;
        $harness = new \App\Domain\UserBuilder();

        try{
            $harness->setUpdated('');

        } catch (\Exception $e){
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }

        $this->assertEquals($expected, $actual);
    }

    public function testUpdatedDateFail01() {
        $date = NOW;
        $expected = '$date is not a string';
        $actual = null;
        $harness = new \App\Domain\UserBuilder();

        try{
            $harness->setUpdated(1);

        } catch (\Exception $e){
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }

        $this->assertEquals($expected, $actual);
    }

    public function testUpdatedDateSuccess() {
        $date = NOW;
        $expected = NOW;
        $actual = null;
        $harness = new \App\Domain\UserBuilder();

        try{
            $harness->setUpdated($date);

        } catch (\Exception $e){
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }

        $this->assertEquals($expected, $harness->getUpdated());
    }

    public function testPasswordFail00(){
        $expected = '$password is empty';
        $actual = null;
        $harness = new \App\Domain\UserBuilder();

        try{
            $harness->setPassword(null);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
    }

    public function testPasswordFail01(){
        $expected = '$password is not a string';
        $actual = null;
        $harness = new \App\Domain\UserBuilder();

        try{
            $harness->setPassword(1);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
    }

    public function testPasswordSuccess00() {
        $expected = '1234pass';
        $harness = new \App\Domain\UserBuilder();

        $harness->setPassword('1234pass');

        $actual = $harness->getPassword();
        $this->assertEquals($expected,$actual);
    }

    public function testPasswordSuccess01() {
        //$expected = password_hash('1234pass',PASSWORD_BCRYPT);
        $harness = new \App\Domain\UserBuilder();

        $harness->setPassword(password_hash('1234pass',PASSWORD_BCRYPT));

        $actual = $harness->getPassword();
        $this->assertTrue(password_verify('1234pass',$harness->getPassword()));
    }


    public function testBuild() {
        //Arrange
        $expect = \App\Domain\User::class;
        $harness = new \App\Domain\UserBuilder();

        $actual = $harness->build();
        $this->assertTrue(method_exists($actual,'getEmail'),'Missing Email method');
        $this->assertTrue(method_exists($actual,'getFullname'),'Missing fullname method');
        $this->assertTrue(method_exists($actual,'getLastname'),'Missing lastname method');
        $this->assertTrue(method_exists($actual,'getFirstname'),'Missing firstname method');
        $this->assertTrue(method_exists($actual,'getPassword'),'Missing Password method');
        $this->assertTrue(method_exists($actual,'getCreated'),'Missing Created method');
        $this->assertTrue(method_exists($actual,'getUpdated'),'Missing Updated method');
        $this->assertEquals($expect, get_class($actual));

    }

}
