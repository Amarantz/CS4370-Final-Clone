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


    /**
    * @expectedException \PDOException
    **/
    public function testDatabaseBadPass()
    {
	$actual = null;
        $db = new \PDO('mysql:host=localhost;dbname=web4350', 'appuser', 'badpassword');
	
        $this->assertTrue(empty($actual));
    }
}
