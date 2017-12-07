<?php


use Phinx\Migration\AbstractMigration;

class AnswerMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->dropTable('upvote');
        $this->dropTable('answer');
        $this->dropTable('questions');
        $this->dropTable('users');

        $table = $this->table('users');
        $table ->addColumn('uuid','string',['limit'=> 300])
            ->addColumn('email','string',['limit' => 300])
            ->addColumn('password','string',['limit' =>300])
            ->addColumn('firstname','string',['limit' => 30])
            ->addColumn('lastname','string',['limit' => 30])
            ->addColumn('created','datetime')
            ->addColumn('updated','datetime')
            ->addColumn('inactive', 'integer', ['default' => 0])
            ->addIndex(['email','uuid','firstname','lastname'])
            ->create();

        $table = $this->table('questions');
        $table->addColumn('uuid','string',['limit'=>300])
            ->addColumn('questionTitle','string',['limit' => 300])
            ->addColumn('questionDetails','string',['limit' => 2000])
            ->addColumn('userID', 'integer')
            ->addColumn('created','datetime')
            ->addColumn('updated', 'datetime')
            ->addColumn('inactive', 'integer', ['default' => 0])
            ->create();


        $table = $this->Table('answer');
        $table->addColumn('uuid','string',['limit' => 300])
            ->addColumn('userID', 'integer')
            ->addColumn('questionID','integer')
            ->addColumn('answer', 'string',['limit' => 2000])
            ->addColumn('created', 'datetime')
            ->addColumn('updated','datetime')
            ->addColumn('upvote','integer')
            ->addColumn('inactive', 'integer', ['default' => 0])
            ->create();

        $table = $this->table('upvote');
        $table->addColumn('userID','integer')
            ->addColumn('answerID', 'integer')
            ->addColumn('inactive', 'integer', ['default' => 0])
            ->create();
    }
}
