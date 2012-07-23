<?php

/**
 * Description of UserMapper
 *
 * @author Kevin Purrmann
 */
class Application_Model_UserMapper extends Standard_Mapper_Abstract
{

	/**
	 * Get current db table
	 * @return Application_Model_DbTable_Users
	 */
	public function getDbTable()
	{
		if (null === $this->_table) {
			$this->setDbTable('Application_Model_DbTable_Users');
		}
		return $this->_table;
	}

	/*
	 * Find Dataset in Dbtable
	 * @var $id
	 * @return $user Application_Model_User
	 */

	public function find($id)
	{
		$result = $this->_table->find($id);
		if (0 == count($result)) {
			return false;
		}
		$row = $result->current();
		return new Application_Model_User($row->toArray());
	}

	/**
	 * @param string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause or Zend_Db_Table_Select object.
	 * @param string|array                      $order  OPTIONAL An SQL ORDER clause.
	 * @param int                               $offset OPTIONAL An SQL OFFSET value.
	 * @return Application_Model_User|false
	 */
	public function findOne($where = null, $order = null, $offset = null)
	{
		if ($row = $this->_table->fetchRow($where, $order, $offset)) {
			return new Application_Model_User($row->toArray());
		}
		return false;
	}

	/**
	 * Saves User in Database and returns UserId or false
	 * @param Application_Model_User $user
	 * @return integer|boolean User Id
	 */
	public function save(Application_Model_User $user)
	{
		$data = array(
			'id'	  => $user->getId(),
			'email'   => $user->getEmail(),
			'active'  => $user->getActive(),
			'hash'	=> $user->getHash(),
			'created' => $user->getCreated(),
		);

		if ($data['id'] != null) {
			return $this->getDbTable()->update($data, array('id = ?' => $data['id']));
		}
		unset($data['id']);
		return $this->getDbTable()->insert($data);
	}

}