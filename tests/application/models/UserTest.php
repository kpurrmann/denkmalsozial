<?php

/**
 * TestClass for UserModel
 *
 * @author Kevin Purrmann
 */
class Application_Model_UserTest extends Zend_Test_PHPUnit_ControllerTestCase {

	public function setUp() {
		$this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
		parent::setUp();
	}

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

}

?>
