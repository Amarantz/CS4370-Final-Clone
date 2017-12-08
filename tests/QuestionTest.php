<?php

use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{
    public function testQuestionSubject()
    {
        //arrange
        $expect  = "This is a Question";
        //act
        $harness = new \App\Domain\QuestionBuilder();
        //assert
        $harness->setQuestion('This is a Question');

        $this->assertTrue(empty($harness->getID()));
        $this->assertEquals($expect, $harness->getQuestion());
    }

    public function testQuestionSubjectFail00()
    {
        //arrange
        $expect  = "This is a Question";
        $harness = new \App\Domain\QuestionBuilder();
        $actual = null;
        //act
        try {
            $harness->setQuestion('');
        } catch (\Exception $e){
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class,get_class($e));
        }
        //assert

        $this->assertNotEquals($expect, $actual);
    }

    public function testQuestionDetails()
    {
        //arrange
        $expect = "this is the body";
        $harness = new \App\Domain\QuestionBuilder();

        //act
        $harness->setDetails('this is the body');
        //assert
        $this->assertEquals($expect, $harness->getDetails());
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
        $harness = new \App\Domain\QuestionBuilder();
        // act
        try {
            $harness->setDetails("");
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
        $harness = new \App\Domain\QuestionBuilder();
        // act
        try {
            $harness->setQuestion('');
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
        $harness = new \App\Domain\QuestionBuilder();

        //act
        try {
            $harness->setQuestion($question);
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
        $body = 'This is a very logn string so long it takes for ever to wright a body longer than 2000 chars                                                                                                                                                                             1231                                                                                                                                                                                  1231                                                                                                                                                                                     1231                                                                                                                                                                                 1231                                                                                                                                                                                      12312                                                                                                                                                                                123123                                                                                                                                                                                 12312                                                                                                                                                                                  12312                                                                                                                                                                               1231                                                                                                                                                                                                                                                                                     1231231 end of line';
        $harness = new \App\Domain\QuestionBuilder();
        //act
        try {
            $harness->setDetails($body);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        $this->assertEquals($expected, $actual);
    }

    public function testQuestionUser()
    {
    //arrange
        $u = new \App\Domain\UserBuilder();
        $u->setEmail('some@email.com');
        $u = $u->build();
        $harness = new \App\Domain\QuestionBuilder();
        $harness->setUser($u);
        $expected = 'some@email.com';
    //act
        $actual = $harness->getUser();
    //assert
        $this->assertEquals($expected, $actual->getEmail());
    }
    public function testQuestionNumber()
    {
    //arragne
        $expect = "Argument is not a string";
        $actual = null;
        $harness = new \App\Domain\QuestionBuilder();

    //act
        try {
            $harness->setQuestion(1);
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
        $harness = new \App\Domain\QuestionBuilder();
    //act
        try {
            $harness->setDetails(1);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        $this->assertEquals($expect, $actual);
    }
}
