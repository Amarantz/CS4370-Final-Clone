<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/constants.php';
class AnswersTest extends TestCase
{
    public function testAnswerUser()
    {
        //arrange
        $u = new \App\Domain\UserBuilder();
        $u = $u->build();
        $harness = new \App\Domain\AnswerBuilder();
        $harness->setUserID($u->getID());
        //act
        $expect = $u->getID();

        $actual = $harness->build();

        $this->assertEquals($expect, $actual->getUserID());
    }

    public function testAwnserBody()
    {
        $message = "We have an awnser that we can anwser with in a short amount of characters";
        $expected = $message;
        $harness = new \App\Domain\AnswerBuilder();
        $harness->setAnswer($message);
        //act
        $actual = $harness->build();
        $this->assertEquals($expected, $actual->getAnswer());
    }

    public function testAwnserFail01()
    {
        $actual = null;
        $expect = '$answer is not a string';

        try {
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
        $expect = NOW;

        $u = new \App\Domain\User("some@email.com", "anna able");
        $a = new \App\Domain\Answer($u, "This is an Answer", "QUE_15123123");
        $actual = $a->getCreationDate();

        $this->assertTrue(!empty($actual));

        $this->assertEquals(1, preg_match('/\d+-\d+-\d+ \d+:\d+:\d+/', $actual));
    }
}
