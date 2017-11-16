<?php

class MemoryStorageTest extends \PHPUnit_Framework_TestCase
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

        $actual = $memory->Get(1);
    }
}
