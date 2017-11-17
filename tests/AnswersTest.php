<?php
use PHPUnit\Framework\TestCase;

class AnswersTest extends TestCase
{
    public function testAnswerUser()
    {
        //arrange
        $u = new \App\Domain\User("some@email.com", "anna able");
        $a = new \App\Domain\Answer($u, "This is an Answer", "QUE_15123123");
        //act
        $expect = "some@email.com";

        $actual = $a->getUser();

        $this->assertEquals($expect, $actual->getEmail());
    }

    public function testAwnserBody()
    {
        $message = "We have an awnser that we can anwser with in a short amount of characters";
        $u = new \App\Domain\User("some@email.com", "anna able");
        $a = new \App\Domain\Answer($u, $message, "QUE_15123123");
        //act
        $actual = $a->getAnswer();

        $this->assertEquals($message, $actual);
    }

    public function testAwnserFail01()
    {
        $actual = null;
        $expect = "Argument is not a string";

        try {
                $u = new \App\Domain\User("some@email.com", "anna able");
            $a = new \App\Domain\Answer($u, 1, "QUE_15123123");
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
            $u = new \App\Domain\User("some@email.com", "anna able");
            $a = new \App\Domain\Answer($u, "", "QUE_15123123");
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }

        $this->assertEquals($expect, $actual);
    }

    public function testAwnserUpvote()
    {
        $expect = 1;

        $u = new \App\Domain\User("some@email.com", "anna able");
        $a = new \App\Domain\Answer($u, "This is an Answer", "QUE_15123123");

        $a->upvote();

        $actual = $a->getUpvote();

        $this->assertEquals($expect, $actual);
    }

    public function testSetAnswerUpvote()
    {
        $expect = 1;

        $u = new \App\Domain\User("some@email.com", "anna able");
        $a = new \App\Domain\Answer($u, "This is an Answer", "QUE_15123123");

        $actual = $a->getUpvote();
        $this->assertEquals($expect-1, $actual);

        $a->upvote();
        $actual = $a->getUpvote();
        $this->assertEquals($expect, $actual);
    }

    public function testCreationDate()
    {
        $expect = date("Y-m-d H:i:s");

        $u = new \App\Domain\User("some@email.com", "anna able");
        $a = new \App\Domain\Answer($u, "This is an Answer", "QUE_15123123");
        $actual = $a->getCreationDate();

        $this->assertTrue(!empty($actual));

        $this->assertEquals(1, preg_match('/\d+-\d+-\d+ \d+:\d+:\d+/', $actual));
    }
}
