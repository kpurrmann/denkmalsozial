<?php

class Application_Model_Flower extends Standard_Model_Abstract
{

	/**
	 * Id of Flower
	 * @var integer 
	 */
	protected $_id;

	/**
	 * Horizontal position of flower
	 * @var float 
	 */
	protected $_position_x;

	/**
	 * Vertical position of flower
	 * @var float
	 */
	protected $_position_y;

	/**
	 * Current status (0-10)
	 * @var integer
	 */
	protected $_status;

	/**
	 * Modified date
	 * @var string
	 */
	protected $_modified;

	/**
	 * Creation date
	 * @var string
	 */
	protected $_created;

	/**
	 * Mapper
	 * @var Application_Model_FlowerMapper
	 */
	protected $_mapper = 'Application_Model_FlowerMapper';

	public function getId()
	{
		return $this->_id;
	}

	public function setId($id)
	{
		$this->_id = $id;
		return $this;
	}

	public function getPosition_x()
	{
		return $this->_position_x;
	}

	public function setPosition_x($position_x)
	{
		$this->_position_x = $position_x;
		return $this;
	}

	public function getPosition_y()
	{
		return $this->_position_y;
	}

	public function setPosition_y($position_y)
	{
		$this->_position_y = $position_y;
		return $this;
	}

	public function getStatus()
	{
		return $this->_status;
	}

	public function setStatus($status)
	{
		$this->_status = $status;
		return $this;
	}

	public function getModified()
	{
		return $this->_modified;
	}

	public function setModified($modified)
	{
		$this->_modified = $modified;
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

}

