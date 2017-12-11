<?php

namespace Tests\Functional;

class AuthTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetAuthRegistration()
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

    public function testPostAuthRegistrationFail00(){
        $response = $this->runApp('POST', '/auth/register', ['f_username' => 'invaide@mail']);

    }

    public function testPostAuthRegistrationFail01(){

    }

    public function testGetAuthLogin(){
        $response = $this->runApp('GET', '/auth/login');
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertContains('Email', (string)$response->getBod());
        $this->assertContains('Password',(string)$response->getBody());

    }



}
