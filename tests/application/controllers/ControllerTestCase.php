<?php

/**
 * Description of ControllerTestCase
 *
 * @author Kevin Purrmann
 */
class ControllerTestCase extends Zend_Test_PHPUnit_ControllerTestCase {

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
		parent::setUp();
	}
}

?>
