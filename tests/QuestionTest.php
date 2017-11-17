<?php

use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{
    public function testQuestionSubject()
    {
        //arrange
        $expect  = "This is a Question";
        //act
        $q = new \App\Domain\Question(new \App\Domain\User("Test@Test.com", "Tester 1"), "This is a Question", "This is our details");
        //assert

        $this->assertTrue(!empty($q->getID()));
        $this->assertEquals($expect, $q->getQuestion());
    }

    public function testQuestionSubjectFail()
    {
        //arrange
        $expect  = "This is a Question";
        //act
        $q = new \App\Domain\Question(new \App\Domain\User("Test@Test.com", "Tester 1"), "This is a Question1121", "This is our details");
        //assert

        $this->assertNotEquals($expect, $q->getQuestion());
    }

    public function testQuestionDetails()
    {
        //arrange
        $expect = "this is the body";
        $q = new \App\Domain\Question(new \App\Domain\User("Test@Test.com", "Tester 1"), "This is a Question", "this is the body");

        //act

        //assert
        $this->assertEquals($expect, $q->getDetails());
    }

    public function testQuestionDetailsFails()
    {
        //arrange
        $expect = "this is the body";

        //act
        $q = new \App\Domain\Question(new \App\Domain\User("Test@Test.com", "Tester 1"), "This is a Question", "this is the body222");
        //assert
        $this->assertNotEquals($expect, $q->getDetails());
    }

    public function testQuestionBodyEmptyArgumentsException()
    {
        // arrange
        $actual = null;
        $expected = "Not a valid Argument";
        // act
        try {
            $q = new \App\Domain\Question(new \App\Domain\User("Test@Test.com", "Tester 1"), "test", "");
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        // assert
        $this->assertEquals($expected, $actual);
    }
    public function testQuestionSubjectEmptyArgumentsException()
    {
        // arrange
        $actual = null;
        $expected = "Not a valid Argument";
        // act
        try {
            $q = new \App\Domain\Question(new \App\Domain\User("Test@Test.com", "Tester 1"), "", "test");
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        // assert
        $this->assertEquals($expected, $actual);
    }

    public function testQuestionLength()
    {
        // arrange
        $actual = null;
        $expected = "Question length is to long";
        $question = "This is a very login string of charectorsd we ewkl;asjdfk;j kldasjfkl;asjkfl; jk; jkd;lfjsak;alsdjkfl;asdjkf; jdf jkdafjkl k;ldanfkl; ankfl;da ji;djf djkakjdk;fjkad;sfjk;alsfjkl;asdfjkl;asdfjkl;asdfjkl;asfjkl;asdfjkal;sdfkl;asdfjkasdfjkalsd;jkl;ldfkldnfals;kdklsdhjkl;fas;kal;kalkajklakl;adklkla;kl;kl;afklakaljl;jkl;ajkasl";
        //act
        try {
            $q = new \App\Domain\Question(new \App\Domain\User("Test@Tests.com", "Tester 1"), $question, "nullBody");
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        $this->assertEquals($expected, $actual);
    }


    public function testQuestionBodyLegth()
    {
        //arragne
        $actual = null;
        $expected = "Question body is to long";
        $body = 'This is a very logn string so long it takes for ever to wright a body longer than 2000 chars                                                                                                                                                                          1231                                                                                                                                                                                  1231                                                                                                                                                                                     1231                                                                                                                                                                                 1231                                                                                                                                                                                      12312                                                                                                                                                                                123123                                                                                                                                                                                 12312                                                                                                                                                                                  12312                                                                                                                                                                               1231                                                                                                                                                                                                                                                                                     1231231 end of line';
        //act
        try {
            $q = new \App\Domain\Question(new \App\Domain\User('Some@Some.com', "Test this shit"), "null question", $body);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        $this->assertEquals($expected, $actual);
    }

    public function testQuestionUser()
    {
    //arrange
        $u = new \App\Domain\User('some@email.com', 'Pass1234');
        $q = new \App\Domain\Question($u, 'Test', 'Test');
        $expected = 'some@email.com';
    //act
        $actual = $q->getUser();
    //assert
        $this->assertEquals($expected, $actual->getEmail());
    }
    public function testQuestionNumber()
    {
    //arragne
        $expect = "Argument is not a string";
        $actual = null;
    //act
        try {
            $q = new \App\Domain\Question(new \App\Domain\User("Test@test.com", "Tester 1"), 1, "test");
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        $this->assertEquals($expect, $actual);
    }
    public function testQuestionBodyNumber()
    {
    //arragne
        $expect = "Argument is not a string";
        $actual = null;
    //act
        try {
            $q = new \App\Domain\Question(new \App\Domain\User("Test@test.com", "Tester 1"), "test", 1);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        $this->assertEquals($expect, $actual);
    }
}
