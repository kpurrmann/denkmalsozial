<?php

/**
 * Description of Abstract
 *
 * @author Kevin Purrmann
 */
abstract class Standard_Mapper_Abstract implements Standard_Mapper_Interface
{

	protected $_table;

	protected function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		$this->_table = $dbTable;
		return $this;
	}

	/**
	 * Gets Current Db_Table, if not set, make a new instance of Zend_Db_Table_Abstract
	 * @param void
	 * @return Zend_Db_Table_Abstract
	 */
	abstract public function getDbTable();
}