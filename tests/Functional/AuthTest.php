<?php

namespace Tests\Functional;

class AuthTest extends BaseTestCase 
{
	public function testsGetAuth()
	{
		$response = $this->runApp('GET','/auth');

		$this->assertEquals(404,$response->getStatusCode());
	}
	public function testsGetRegistration()
	{
		$response = $this->runApp('GET','/auth/register');
		$this->assertEquals(200,$response->getStatusCode());

		$this->assertContains('Registration',(string)$response->getBody());
		$this->assertContains('Email',(string)$response->getBody());
		$this->assertContains('Firstname',(string)$response->getBody());
		$this->assertContains('Lastname',(string)$response->getBody());
		$this->assertContains('Password',(string)$response->getBody());
		$this->assertContains('Confirm Password',(string)$response->getBody());
	}
	public function testPostRegistrationFail00(){
		$response = $this->runApp('POST','/auth/register', [
			'f_username' => 'some some.com',
			'f_firstname' => 'testing',
			'f_lastname' => 'testing',
			'f_password' => '1234pass',
			'f_confirmPassword' => '1234pass',
		]);
		$this->assertContains('No White space',(string)$response->getBody());
	
	}
}
