<?php

/**
 * User Model
 * 
 * @author Kevin Purrmann
 */
class Application_Model_User extends Standard_Model_Abstract
{

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

	/**
	 * Mapper
	 * @var Application_Model_UserMapper
	 */
	protected $_mapper;

	public function getMapper()
	{
		if (null === $this->_mapper) {
			$this->setMapper(new Application_Model_UserMapper());
		}
		return $this->_mapper;
	}

	public function getId()
	{
		return (int) $this->_id;
	}

	public function setId($id)
	{
		$this->_id = $id;
		return $this;
	}

	public function getEmail()
	{
		return $this->_email;
	}

	public function setEmail($email)
	{
		$this->_email = $email;
		return $this;
	}

	public function getActive()
	{
		if (!$this->_active) {
			$this->setActive(0);
		}
		return $this->_active;
	}

	public function setActive($active)
	{
		$this->_active = $active;
		return $this;
	}

	public function getHash()
	{
		if (!$this->_hash) {
			$this->setHash($this->createHash($this->_email));
		}
		return $this->_hash;
	}

	public function setHash($hash)
	{
		$this->_hash = $hash;
		return $this;
	}

	public function getCreated()
	{
		return $this->_created;
	}

	public function setCreated($created)
	{
		$this->_created = $created;
		return $this;
	}

	/**
	 * Creates Hash
	 * @return String $hash
	 */
	private function createHash($email)
	{
		$date = new Zend_Date();
		return md5($email . $date->toString() . uniqid());
	}

}