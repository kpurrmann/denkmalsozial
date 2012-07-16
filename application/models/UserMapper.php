<?php

/**
 * Description of UserMapper
 *
 * @author Kevin Purrmann
 */
class Application_Model_UserMapper extends Standard_Mapper_Abstract {

	protected $_dbTableName = 'Application_Model_DbTable_Users';

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

		if (isset($data['hash']))
			$user->setHash($data['hash']);

		if (isset($data['active']))
			$user->setActive($data['active']);

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
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return false;
		}
		$row  = $result->current();
		$user = $this->createUser($row->toArray());
		return $user;

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
			return $this->getDbTable()->insert($data);
		}
		return false;
	}

}

?>
