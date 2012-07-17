<?php

/**
 * User Model
 * 
 * @author Kevin Purrmann
 */
class Application_Model_User {

	/**
	 * User Id
	 * @var integer
	 */
	protected $_id;

	/**
	 * User email adress
	 * @var string
	 */
	protected $_email;

	/**
	 * User active status
	 * @var boolean
	 */
	protected $_active;

	/**
	 * User individual hash code
	 * @var string
	 */
	protected $_hash;

	/**
	 * User creation date
	 * @var Zend_Date
	 */
	protected $_created;

	public function getId() {
		return $this->_id;
	}

	public function setId($id) {
		$this->_id = $id;
	}

	public function getEmail() {
		return $this->_email;
	}

	public function setEmail($email) {
		$this->_email = $email;
	}

	public function getActive() {
		return $this->_active;
	}

	public function setActive($active) {
		$this->_active = $active;
	}

	public function getHash() {
		return $this->_hash;
	}

	public function setHash($hash) {
		$this->_hash = $hash;
	}

	public function getCreated() {
		return $this->_created;
	}

	public function setCreated($created) {
		$this->_created = $created;
	}

	/**
	 * Returns Array with actual Object
	 * @return $array Array
	 */
	public function toArray() {
		$array = array();
		$array['id']	  = $this->getId();
		$array['email']   = $this->getEmail();
		$array['active']  = $this->getActive();
		$array['hash']	  = $this->getHash();
		$array['created'] = $this->getCreated();
		return $array;
	}

}