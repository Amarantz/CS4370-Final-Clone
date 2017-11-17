<?php
use PHPUnit\Framework\TestCase;

class MysqlPluginTest extends TestCase
{

    protected $harness;

    public function setUp()
    {
        $harness = new \PDO("mysql:dbname=;host=localhost", 'appuser', 'Kmustang@1');
    }

    public function testCanaire()
    {
        $this->assertTrue(true);
    }
}
