<?php
namespace Tests\Storage;
use Doctrine\Instantiator\Exception\UnexpectedValueException;
use PHPUnit\Framework\TestCase;

class TestClass00
{
    protected $ID;
    protected $data;

    function __construct($ID, $data)
    {
        $this->ID = $ID;
        $this->data = $data;
    }
    public function GetID() {
        return $this->ID;
    }

    public function getDATA() {
         return $this->data;
    }

    public function toArray() {
        return array(
            'uuid' => $this->ID,
            'data' => $this->data,
        );
    }


}


class MemoryStorageTest extends TestCase
{
    public function testMemoryStorageConstructor()
    {
        $actual = new \App\Storage\MemoryPlugin();
        $expected = 'App\Storage\MemoryPlugin';

        $this->assertEquals($expected, get_class($actual));
    }

    public function testMemoryStorageInsert()
    {
        $expected = new \App\Domain\User("Test@Test.com", "Testser Is dead");
        $userM = new \App\Storage\MemoryPlugin();

        $userM->Insert($expected);
        $actual = $userM->get($expected->getID());

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionMessage $item is not a object
     */
    public function testMemoryStorageNumber()
    {
        $memory = new \App\Storage\MemoryPlugin();

        $memory->Insert(1);
        $expect = null;
        $actual = $memory->Get(1);
        $this->assertEquals($expect, $actual);
    }

    public function testMemoryStorageMoreThanOneItem()
    {
        $memory = new \App\Storage\MemoryPlugin();
        $u = new \App\Domain\User("this@email.com", "tester 1");
        $q = new \App\Domain\Question($u, "Subject", "This is my problem can I get some help Thanks");

        $memory->Insert($u);
        $memory->Insert($q);

        $expectedCount = 2;
        $this->assertEquals($expectedCount, $memory->count());
        $expected = $u;

        $result = $memory->Get($u->getID());

        $this->assertEquals($expected, $result);
    }

    public function testMemoryStroageRemove()
    {
        $u = new \App\Domain\User("this@email.com", "tester 1");

        $id = $u->getID();

        $memory = new \App\Storage\MemoryPlugin();
        $memory->Insert($u);

        $this->assertEquals(1, $memory->count());

        $memory->Remove($id);

        $this->assertEquals(0, $memory->count());
    }

    public function testMemoryStorageRemoveAll()
    {
        $memory = new \App\Storage\MemoryPlugin();
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));

        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));
        $memory->Insert(new \App\Domain\User("thisis@a.test", "Tester shit"));

        $this->assertEquals(13, $memory->count());

        $memory->RemoveAll();

        $this->assertEquals(0, $memory->count());
    }
    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionMessage $item is not a object
     */
    public function testMemoryStroageString()
    {
        $memory = new \App\Storage\MemoryPlugin();
        $string = " This is a random string";
        $memory->Insert($string);
        $expect = null;
        $actual = $memory->Get($string);
        $this->assertEquals($expect, $actual);
    }
}
