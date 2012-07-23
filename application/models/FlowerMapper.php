<?php

class Application_Model_FlowerMapper extends Standard_Mapper_Abstract
{

	/**
	 * Get current db table
	 * @return Application_Model_DbTable_Flowers
	 */
	public function getDbTable()
	{
		if (null === $this->_table) {
			$this->setDbTable('Application_Model_DbTable_Flowers');
		}
		return $this->_table;
	}

	/**
	 * Get one flower from current table
	 * @param type $id
	 * @return boolean|\Application_Model_Flower
	 */
	public function find($id)
	{
		$result = $this->_table->find($id);
		if (0 === count($result)) {
			return false;
		}
		$row = $result->current();
		return new Application_Model_Flower($row->toArray());
	}

	/**
	 * Catches all Flowers in database
	 * @todo Check return type, may Rowset would be better
	 * @param array $where
	 * @param array $order
	 * @param int $count
	 * @param int $offset
	 * @return boolean|\Application_Model_Flower
	 */
	public function fetchAll($where = null, $order = null, $count = null, $offset = null)
	{
		$results = $this->_table->fetchAll($where, $order, $count, $offset);
		if (0 === count($results)) {
			return false;
		}
		$flowerArray = array();
		foreach ($results as $row) {
			$flowerArray[] = new Application_Model_Flower($row->toArray());
		}
		return $flowerArray;
	}

}

