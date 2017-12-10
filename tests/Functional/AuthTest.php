<?php

namespace Tests\Functional;

class AuthTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetAuth()
    {
        $response = $this->runApp('GET', '/auth/register');

        $this->assertEquals(200, $response->getStatusCode());
        //$this->assertContains('Welcome to Web4350 Exchange', (string)$response->getBody());
        $this->assertContains('Email', (string)$response->getBody());
        $this->assertContains('Firstname', (string)$response->getBody());
        $this->assertContains('Lastname', (string)$response->getBody());
        $this->assertContains('Password', (string)$response->getBody());
        $this->assertContains('Register', (string)$response->getBody());
    }



}
