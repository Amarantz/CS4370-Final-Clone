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

    public function testAnswerBody()
    {
        $message = "We have an awnser that we can anwser with in a short amount of characters";
        $expected = $message;
        $harness = new \App\Domain\AnswerBuilder();
        $harness->setAnswer($message);
        //act
        $actual = $harness->build();
        $this->assertEquals($expected, $actual->getAnswer());
    }

    public function testAnswerFail00()
    {
        $actual = null;
        $expect = '$string is empty';
        $harness = new \App\Domain\AnswerBuilder();

        try {
            $harness->setAnswer('');
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        $this->assertEquals($expect, $actual);
    }

    public function testAwnserFail01()
    {
        $actual = null;
        $expect = '$string is not a string';
        $harness = new \App\Domain\AnswerBuilder();

        try {
            $harness->setAnswer(1);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        $this->assertEquals($expect, $actual);
    }

    public function testAwnserUpvoteSet()
    {

        $expect = 0;
        $harness = new \App\Domain\AnswerBuilder();
        $harness->setUpvote(0);

        $actual = $harness->build();

        $this->assertEquals($expect, $actual->getUpvote());
    }

    public function testSetAnswerUpvote()
    {
        $expect = 1;
        $harness = new \App\Domain\AnswerBuilder();
        $harness->setUpvote(0);

        $actual = $harness->build();
        $this->assertEquals($expect-1, $actual->getUpvote());

        $actual->upvote();
        $this->assertEquals($expect, $actual->getUpvote());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $upvote is not a number
     */
    public function testSetAnswerUpvoteFail00()
    {
        $expect = 1;
        $harness = new \App\Domain\AnswerBuilder();
        $harness->setUpvote("This is a string");

        $actual = $harness->build();
        $this->assertEquals($expect-1, $actual->getUpvote());

        $actual->upvote();
        $this->assertEquals($expect, $actual->getUpvote());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $upvote is not a number
     */
    public function testSetAnswerUpvoteFail01()
    {
        $expect = 1;
        $harness = new \App\Domain\AnswerBuilder();
        $harness->setUpvote("");

        $actual = $harness->build();
        $this->assertEquals($expect-1, $actual->getUpvote());

        $actual->upvote();
        $this->assertEquals($expect, $actual->getUpvote());
    }

    public function testCreationDate()
    {
        $expect = NOW;

        $harness = new \App\Domain\AnswerBuilder();
        $harness->setCreated(NOW);

        $actual = $harness->build();
        $this->assertEquals($expect, $actual->getCreated());
        $this->assertEquals(1, preg_match('/\d+-\d+-\d+ \d+:\d+:\d+/', $actual->getCreated()));
    }

    /**
 * @expectedException \InvalidArgumentException
 * @expectedExceptionMessage $date is empty
 */
    public function testCreationDateFail00()
    {
        $expect = NOW;

        $harness = new \App\Domain\AnswerBuilder();
        $harness->setCreated('');

        $actual = $harness->build();

        $this->assertEquals(1, preg_match('/\d+-\d+-\d+ \d+:\d+:\d+/', $actual->getCreated()));
    }
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $date is not a String
     */
    public function testCreationDateFail01()
    {
        $expect = NOW;

        $harness = new \App\Domain\AnswerBuilder();
        $harness->setCreated(1);

        $actual = $harness->build();

        $this->assertEquals(1, preg_match('/\d+-\d+-\d+ \d+:\d+:\d+/', $actual->getCreated()));
    }

    public function testUpdatedDate()
    {
        $expect = NOW;

        $harness = new \App\Domain\AnswerBuilder();
        $harness->setUpdated(NOW);

        $actual = $harness->build();
        $this->assertEquals($expect, $actual->getUpdated());
        $this->assertEquals(1, preg_match('/\d+-\d+-\d+ \d+:\d+:\d+/', $actual->getUpdated()));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $date is empty
     */
    public function testUpdatedDateFail00()
    {
        $expect = NOW;

        $harness = new \App\Domain\AnswerBuilder();
        $harness->setUpdated('');

        $actual = $harness->build();

        $this->assertEquals(1, preg_match('/\d+-\d+-\d+ \d+:\d+:\d+/', $actual->getUpdated()));
    }
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $date is not a String
     */
    public function testUpdatedDateFail01()
    {
        $expect = NOW;

        $harness = new \App\Domain\AnswerBuilder();
        $harness->setUpdated(1);

        $actual = $harness->build();

        $this->assertEquals(1, preg_match('/\d+-\d+-\d+ \d+:\d+:\d+/', $actual->getUpdated()));
    }

    public function testToArray() {
        $harness = new \App\Domain\AnswerBuilder();

        $actual = $harness->build();

        $this->assertArrayHasKey('uuid',$actual->toArray());
        $this->assertArrayHasKey('userID',$actual->toArray());
        $this->assertArrayHasKey('created',$actual->toArray());
        $this->assertArrayHasKey('updated',$actual->toArray());
        $this->assertArrayHasKey('answer',$actual->toArray());
        $this->assertArrayHasKey('questionID',$actual->toArray());
        $this->assertArrayHasKey('upvote',$actual->toArray());
    }
}
