<?php
use PHPUnit\Framework\TestCase;
class MemoryStorageTest extends TestCase
{
    public function testMemoryStorageConstructor()
    {
        $actual = new \App\Storage\MemoryStorage();
        $expected = 'App\Storage\MemoryStorage';

        $this->assertEquals($expected, get_class($actual));
    }

    public function testMemoryStorageInsert()
    {
        $expected = new \App\Domain\User("Test@Test.com", "Testser Is dead");
        $userM = new \App\Storage\MemoryStorage();

        $userM->Insert($expected);
        $actual = $userM->get($expected->getID());

        $this->assertEquals($expected, $actual);
    }

    public function testMemoryStorageNumber()
    {
        $memory = new \App\Storage\MemoryStorage();

        $memory->Insert(1);
        $expect = null;
        $actual = $memory->Get(1);
        $this->assertEquals($expect, $actual);
    }

    public function testMemoryStorageMoreThanOneItem()
    {
        $memory = new \App\Storage\MemoryStorage();
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

        $memory = new \App\Storage\MemoryStorage();
        $memory->Insert($u);

        $this->assertEquals(1, $memory->count());

        $memory->Remove($id);

        $this->assertEquals(0, $memory->count());
    }

    public function testMemoryStorageRemoveAll()
    {
        $memory = new \App\Storage\MemoryStorage();
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
    public function testMemoryStroageString()
    {
        $memory = new \App\Storage\MemoryStorage();
        $string = " This is a random string";
        $memory->Insert($string);
        $expect = null;
        $actual = $memory->Get($string);
        $this->assertEquals($expect, $actual);
    }
}
