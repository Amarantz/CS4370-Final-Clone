<?php
/**
 * Created by PhpStorm.
 * User: Blaine
 * Date: 12/4/2017
 * Time: 6:05 PM
 */

namespace Tests\Storage;
use PHPUnit\Framework\TestCase;
class QuestionRepositoryTest extends TestCase
{
    /** @var \Slim\App $app */
    protected $app;

    public function setup()
    {
        $settings = include __DIR__ . '/../../src/settings.php';
        $app = new \Slim\App($settings);
        require __DIR__ . '/../../src/dependencies.php';

        $this->app = $app;
    }

    public function testNewQuestionRepository() {
        //Arrange
        $c = $this->app->getContainer();
        /** @var \App\Storage\QuestionRepository $repo */
        $repo = $c->get('QuestionRepositoryEloquent');

        $users = $repo->FindAll();

        $this->assertTrue(!empty($users));

    }
}