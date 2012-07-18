<?php

/**
 * Description of UserMapper
 *
 * @author Kevin Purrmann
 */
class Application_Model_UserMapper extends Standard_Mapper_Abstract {

	/**
	 * Classname of type Zend_Db_Table_Abstract
	 * @var String
	 */
	protected $_dbTableName = 'Application_Model_DbTable_Users';
	/**
	 * 
	 * @var Zend_Db_Table_Abstract
	 */
	protected $_table;

	/**
	 * Constructor sets table
	 */
	public function __construct() {
		$this->_table = $this->getDbTable();
	}

	/**
	 * Creates a User
	 * @var array $data
	 * @return Application_Model_User $user
	 */
	public function createUser(array $data) {
		$user = new Application_Model_User();
		if (isset($data['id']))
			$user->setId($data['id']);

		if (isset($data['email']))
			$user->setEmail($data['email']);
		else
			return false;

		if (isset($data['hash']))
			$user->setHash($data['hash']);
		else
			$user->setHash($this->createHash($user->getEmail()));

		if (isset($data['active']))
			$user->setActive($data['active']);
		else
			$user->setActive(false);

		if (isset($data['created']))
			$user->setCreated($data['created']);

		return $user;
	}

	/*
	 * Find Dataset in Dbtable
	 * @var $id
	 * @return $user Application_Model_User
	 */

	public function find($id) {
		$result = $this->_table->find($id);
		if (0 == count($result)) {
			return false;
		}
		$row  = $result->current();
		$user = $this->createUser($row->toArray());
		return $user;
	}

	/**
	 * Find Dataset of User depends on hashstring
	 * @var string $hash
	 * @return Application_Model_User | false
	 */
	public function findByHash($hash) {
		$select = $this->_table->select()->where('hash = ?', $hash);
		if($row	= $this->_table->fetchRow($select)){
			$user   = $this->createUser($row->toArray());
			return $user;
		}
		return false;
	}

	/**
	 * Saves User in Database and returns UserId or false
	 * @var Application_Model_User $user
	 * @return $userId Integer | boolean
	 */
	public function save(Application_Model_User $user) {

		$data = $user->toArray();
		if ($data != null && !empty($data) &&
		   !empty($data['email']) && $data['email'] != null) {
			if(isset($data['id']) && $data['id'] != null) {
				return $this->getDbTable()->update($data, array('id = ?' => $data['id']));
			}
			return $this->getDbTable()->insert($data);
		}
		return false;
	}

	/**
	 * Creates Hash
	 * @return String $hash
	 */
	private function createHash($email) {
		$date = new Zend_Date();
		return md5($email . $date->toString() . uniqid());
	}

}