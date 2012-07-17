<?php

/**
 * Description of Abstract
 *
 * @author Kevin Purrmann
 */
abstract class Standard_Mapper_Abstract {

	protected $_dbTable;
	protected $_dbTableName;

	public function setDbTable($dbTable) {
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		$this->_dbTable = $dbTable;
		return $this;
	}

	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable($this->_dbTableName);
		}
		return $this->_dbTable;
	}

}