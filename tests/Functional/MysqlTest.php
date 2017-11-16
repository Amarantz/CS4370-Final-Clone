<?php

namespace Tests\Functional;

class MysqlTest extends BaseTestCase
{

    public function testDatabase()
    {
        $db = new \PDO('mysql:host=localhost;dbname=web4350', 'appuser', 'Kmustang@1');
        $sql = "select now()";
        $sql = $db->prepare($sql);

        $result = $sql->execute();

        $this->assertTrue(isset($result));
    }

    public function testDatabaseBadPass()
    {

        $actual = null;
        try {
            $db = new \PDO('mysql:host=localhost;dbname=web4350', 'appuser', 'badpassword');
        } catch (\Exception $e) {
            $actual = $e->getMessage();
        }

        $this->assertTrue(!empty($actual));
    }
}
