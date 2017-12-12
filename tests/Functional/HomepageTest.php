<?php

namespace Tests\Functional;

class HomepageTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetHomepage()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        //$this->assertContains('Welcome to Web4350 Exchange', (string)$response->getBody());
        $this->assertContains('Login', (string)$response->getBody());
    }

    public function testGetHomepageRegister()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        //$this->assertContains('Welcome to Web4350 Exchange', (string)$response->getBody());
        $this->assertContains('Register', (string)$response->getBody());
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostHomepageNotAllowed()
    {
        $response = $this->runApp('POST', '/', ['test']);

        $this->assertEquals(405, $response->getStatusCode());
        // Because we can post in to the middleware for authentication we can post it directly to the home page and it handles the login.
       $this->assertContains('Method not allowed', (string)$response->getBody());
    }


}
