<?php

namespace Tests\Functional;

class MemcacheTest extends BaseTestCase
{

    public function testMemcache()
    {
        //Arrange
        $m = new \Memcache;

        $m->addServer('127.0.0.1');

        //Act
        $expected = "This is some Value";
        $m->add("Key", "This is some Value", false, 30);

        $result = $m->get("Key");

        //Assert
        $this->assertEquals($expected, $result);
    }
}
