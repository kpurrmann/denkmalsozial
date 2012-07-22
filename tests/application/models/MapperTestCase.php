<?php

require_once '../library/Ibuildings/Test/PHPUnit/DatabaseTestCase/Abstract.php';

/**
 * Description of MapperTestCase
 *
 * @author Kevin Purrmann
 */
class MapperTestCase extends Ibuildings_Test_PHPUnit_DatabaseTestCase_Abstract {

	protected $_dataSet;

	protected function setUp() {
		$this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
		$this->_dataSet = new Zend_Test_PHPUnit_Db_DataSet_QueryDataSet($this->getConnection());
		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();
	}

}

?>
