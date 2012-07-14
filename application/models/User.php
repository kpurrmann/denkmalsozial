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

}

?>
