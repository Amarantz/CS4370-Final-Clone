<?php

namespace Tests\Storage;

use App\Storage\EloquentPlugin;
use Doctrine\Instantiator\Exception\UnexpectedValueException;
use Illuminate\Database\Capsule\Manager;
use phpDocumentor\Compiler\Pass\ElementsIndexBuilder;
use PHPUnit\Framework\TestCase;

class TestClass01 {

    protected $ID;
    protected $data;
    public function __construct($ID, $data)
    {
        $this->ID = $ID;
        $this->data  = $data;
    }

    public function GetID()
    {
     return  $this->ID;
    }

    public function getData()
    {
        return $this->data;
    }


}
class TestEloquentPlugin extends TestCase
{
    /** @var $db  Manager */
    protected $db;
    public function setup()
    {

        $this->db = new Manager();
        $this->db->addConnection(array(
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'web4350',
            'username' => 'appuser',
            'password' => 'Kmustang@1',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ));

        $this->db->bootEloquent();
        $this->db->setAsGlobal();

        $this->db::statement('CREATE TABLE IF NOT EXISTS 
              test_table ( id INT(11) NOT NULL AUTO_INCREMENT,
              uuid varchar(100), data varchar(200), inactive int(2) default 0, PRIMARY KEY (id));');
    }

    public function tearDown() {
        $this->db::statement('Drop table test_table;');
    }

    public function testConstructor() {
        $harness = new EloquentPlugin($this->db->table('users'));
        $this->assertEquals(EloquentPlugin::class,get_class($harness));
    }

    public function testCreateObject00() {

        $expected = 1;
        $harness = new EloquentPlugin($this->db->table('test_table'));
        $item = new TestClass00('1234abcd', 'foobar');


        $actual = $harness->Insert($item);

        $this->assertEquals($expected,$actual);
        $actual = $harness->GetAll();
        $this->assertEquals(1,count($actual));
    }

    public function testCreateObject01() {
        $expected = 1;
        $harness = new EloquentPlugin($this->db->table('test_table'));
        $item = new TestClass00('1234abcd', 'foobar');

        $harness->Insert($item);

        $actual = $harness->Get('1234abcd');

        $this->assertEquals($expected, count($actual));
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testRemoveFail00(){
        $item1 = new TestClass00('123444abc', 'foobar2');
        $item = new TestClass00('1234abcd', 'foobar');

        $harness = new EloquentPlugin($this->db->table('test_table'));

        $harness->Insert($item1);
        $harness->Insert($item);

        $harness->Remove('');
    }

    public function testRemoveSuccess() {
        $item1 = new TestClass00('123444abc', 'foobar2');
        $item = new TestClass00('1234abcd', 'foobar');

        $harness = new EloquentPlugin($this->db->table('test_table'));

        $harness->Insert($item1);
        $harness->Insert($item);
        $actual = $harness->GetAll();
        //print_r($actual);
        // test to make sure we are getting to items back.
        $this->assertEquals(2,count($actual));
        $expect = 1;
        $harness->Remove('1234abcd');
        //$harness = new EloquentPlugin($this->db->table('test_table'));
        $actual = $harness->GetAll();
        //print_r($actual);
        // checking to see that we get one item back as we should only set one record to
        $this->assertNotEmpty($actual);
        $this->assertEquals($expect, count($actual));
    }

    public function testRemoveFail01() {
        $item1 = new TestClass00('123444abc', 'foobar2');
        $item = new TestClass00('1234abcd', 'foobar');

        $harness = new EloquentPlugin($this->db->table('test_table'));

        $harness->Insert($item1);
        $harness->Insert($item);
        $actual = $harness->GetAll();
        // test to make sure we are getting to items back.
        $this->assertEquals(2,count($actual));
        $expect = '$ID is not a string';
        try{
            $harness->Remove(111);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(UnexpectedValueException::class, get_class ($e));
        }
        // $actual = $harness->GetAll();
        // checking to see that we get one item back as we should only set one record to
        $this->assertNotEmpty($actual);
        $this->assertEquals($expect, $actual);
    }

    public function testRemoveAllSuccess() {
        $item1 = new TestClass00('123444abc', 'foobar2');
        $item = new TestClass00('1234abcd', 'foobar');

        $harness = new EloquentPlugin($this->db->table('test_table'));

        $harness->Insert($item1);
        $harness->Insert($item);

        $actual = $harness->GetAll();
        $expected = 2;

        $this->assertEquals($expected, count($actual));

        $harness->RemoveAll();
        $actual = $harness->GetAll();

        $expected = 0;
        $this->assertEquals($expected,count($actual));

    }

    public function testModifyFail00 (){
        $item = new TestClass00 ('1241aaaccc', 'Some Data');
        $harness = new EloquentPlugin($this->db->table('test_table'));
        $harness->insert($item);

        $actual = null;
        $expected = '$ID does not exist';

        try{
            $harness->Modify("",$item);

        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(UnexpectedValueException::class, get_class($e));
        }

        $this->assertEquals($expected,$actual);
    }

    public function testModifyFail01   (){
        $item = new TestClass00 ('1241aaaccc', 'Some Data');
        $harness = new EloquentPlugin($this->db->table('test_table'));
        $harness->insert($item);

        $actual = null;
        $expected = '$item does not exist';

        try{
            $harness->Modify('151231','');

        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(UnexpectedValueException::class, get_class($e));
        }

        $this->assertEquals($expected,$actual);
    }

    public function testModifyFail02 () {
        $item = new TestClass00 ('12311', 'somedata');
        $harness = new EloquentPlugin($this->db->table('test_table'));
        $item2 = new TestClass01('12311', 'Some Data');
        $harness->insert($item);

        $actaul = null;

        $expected = '$item does not have a toArray() method';

        try {
            $harness->Modify('12311', $item2);
        } catch (\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(UnexpectedValueException::class, get_class($e));
        }

        $this->assertEquals($expected,$actual);

    }

    public function testGetByStringSuccess(){
        $item = new TestClass00 ('12311', 'somedata');
        $harness = new EloquentPlugin($this->db->table('test_table'));

        $expect = $item;
        $harness->insert($item);

        $harness->SetGetByStringColumn('data');
        $actual = $harness->GetByString('somedata');

        //print_r($actual);
        $this->assertEquals(1,count($actual));
        //$this->assertEquals($expect->GetID(), $actual[0]['uuid']);
        //$this->assertEquals($expect->getDATA(), $actual[0]['data']);
    }

    public function testGetByStringFail00(){
        $item = new TestClass00 ('12311', 'somedata');
        $harness = new EloquentPlugin($this->db->table('test_table'));
        $actual = null;
        $expect = '$column_name is empty';
        $harness->insert($item);

        try{
            $harness->SetGetByStringColumn('');

        }catch (\Exception $e){
            $actual = $e->getMessage();
            $this->assertEquals(\UnexpectedValueException::class,get_class($e));
        }

        $this->assertEquals($expect,$actual);
    }


}