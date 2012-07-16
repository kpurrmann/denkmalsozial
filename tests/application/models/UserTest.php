<?php

/**
 * TestClass for UserModel
 *
 * @author Kevin Purrmann
 */
class Application_Model_UserTest extends ControllerTestCase {

	public function testCanCreateUser() {
		$user = new Application_Model_User();
		$this->assertInstanceOf('Application_Model_User', $user);
	}

	public function testUserObjectHasAttributes() {
		$user = new Application_Model_User();
		$this->assertObjectHasAttribute('_id', $user);
		$this->assertObjectHasAttribute('_email', $user);
		$this->assertObjectHasAttribute('_active', $user);
		$this->assertObjectHasAttribute('_hash', $user);
		$this->assertObjectHasAttribute('_created', $user);
	}

	public function testCanSetAttributes() {
		$user = new Application_Model_User();
		$date = new Zend_Date();
		$user->setId(1);
		$user->setEmail('string');
		$user->setActive(true);
		$user->setHash('string');
		$user->setCreated($date);

		$this->assertEquals(1, $user->getId());
		$this->assertInternalType('integer', $user->getId());

		$this->assertEquals('string', $user->getEmail());
		$this->assertInternalType('string', $user->getEmail());

		$this->assertTrue($user->getActive());
		$this->assertInternalType('boolean', $user->getActive());

		$this->assertEquals('string', $user->getHash());
		$this->assertInternalType('string', $user->getHash());

		$this->assertEquals($date, $user->getCreated());
		$this->assertInstanceOf('Zend_Date', $user->getCreated());
	}

	public function testCanConvertObjectAttributesToArray() {
		$user  = new Application_Model_User();
		$date  = new Zend_Date();
		$user->setId(1);
		$user->setEmail('string');
		$user->setActive(true);
		$user->setHash('string');
		$user->setCreated($date);
		$array = $user->toArray();
		$this->assertArrayHasKey('id', $array);
		$this->assertArrayHasKey('email', $array);
		$this->assertArrayHasKey('active', $array);
		$this->assertArrayHasKey('hash', $array);
		$this->assertArrayHasKey('created', $array);
	}

}

?>
