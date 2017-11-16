<?php

class AnswersTest extends \PHPUnit_Framework_TestCase
{
    public function testAwnserUser()
    {
        //arrange
        $u = new \App\Domain\User("some@email.com", "anna able");
        $a = new \App\Domain\Answer();
        //act
        $expect = "some@email.com";

        $a->setUser($u);
        $actual = $a->getUser();

        $this->assertEquals($expect, $actual->getEmail());
    }

    public function testAwnserBody()
    {
        $message = "We have an awnser that we can anwser with in a short amount of characters";
        $a = new \App\Domain\Answer();
        //act
        $a->setAnswer($message);
        $actual = $a->getAnswer();

        $this->assertEquals($message, $actual);
    }

    public function testAwnserFail01()
    {
        $actual = null;
        $expect = "Argument is not a string";

        try {
            $a = new \App\Domain\Answer();
            $a->setAnswer(1);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }

        $this->assertEquals($expect, $actual);
    }

    public function testAnswerEmpty()
    {
        $actual = null;
        $expect = "Argument is empty";

        try {
            $a = new \App\Domain\Answer();
            $a->setAnswer("");
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }

        $this->assertEquals($expect, $actual);
    }

    public function testAwnserUpvote()
    {
        $expect = 1;

        $a = new \App\Domain\Answer();

        $a->upvote();

        $actual = $a->getUpvote();

        $this->assertEquals($expect, $actual);
    }

    public function testSetAnswerUpvote()
    {
        $expect = 13;

        $a = new \App\Domain\Answer();
        $a->setUpvote(12);

        $actual = $a->getUpvote();
        $this->assertEquals($expect-1, $actual);

        $a->upvote();
        $actual = $a->getUpvote();
        $this->assertEquals($expect, $actual);
    }

    public function testCreationDate()
    {
        $expect = date("Y-m-d H:i:s");

        $a = new \App\Domain\Answer();
        $actual = $a->getCreationDate();

        $this->assertTrue(!empty($actual));

        $this->assertEquals(1, preg_match('/\d+-\d+-\d+ \d+:\d+:\d+/', $actual));
    }
}
