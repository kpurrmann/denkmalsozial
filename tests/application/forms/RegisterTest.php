<?php

/**
 * Description of Register
 *
 * @author Kevin Purrmann
 */
class Application_Forms_RegisterTest extends ControllerTestCase {

	/**
	 * Current Form
	 * @var Application_Form_Register
	 */
	protected $_form;

	/**
	 * Actual Hash String
	 * @var String
	 */
	protected $_hash;

	/**
	 * Current data
	 * @var array
	 */
	protected $_data;

	protected function setUp() {
		parent::setUp();
		$this->_form = new Application_Form_Register();
		$this->_hash = $this->createHash();
		$this->_data = array(
		   'email'   => 'newuser'. uniqid().'@test.de',
		   'msg'	 => '',
		   'ds_hash' => $this->_hash,
		   'submit'  => 'submit',
		);
	}

	public function testCanCreateForm() {
		$this->assertInstanceOf('Zend_Form', $this->_form);
		$this->assertInstanceOf('Application_Form_Register', $this->_form);
		$this->assertEquals('/user/create', $this->_form->getAction());
		$this->assertEquals('post', $this->_form->getMethod());
	}

	public function testFormHasElements() {
		$this->assertInstanceOf('Zend_Form_Element_Text', $this->_form->getElement('email'));
		$this->assertInstanceOf('Zend_Form_Element_Text', $this->_form->getElement('msg'));
		$this->assertInstanceOf('Zend_Form_Element_Hash', $this->_form->getElement('ds_hash'));
		$this->assertInstanceOf('Zend_Form_Element_Submit', $this->_form->getElement('submit'));
	}

	public function testFormCanHandleHash() {
		$falseCsrf = new Zend_Form_Element_Hash('false_ds_hash');
		$falseHash = $falseCsrf->getHash();

		$this->assertTrue($this->_form->isValid($this->_data));

		$this->_data['ds_hash'] = $falseHash;
		$this->assertFalse($this->_form->isValid($this->_data));
	}

	public function testFormCanHandleEmail() {
		$this->assertTrue($this->_form->isValid($this->_data));

		// Already in Database
		$this->_data['email'] = 'user1@test.de';
		$this->assertFalse($this->_form->isValid($this->_data));

		// No Email
		$this->_data['email'] = 'user1test.de';
		$this->assertFalse($this->_form->isValid($this->_data));
	}

	public function testFormCanHandleHoneypot() {
		$this->assertTrue($this->_form->isValid($this->_data));

		$this->_data['msg'] = '1234';
		$this->assertFalse($this->_form->isValid($this->_data));
	}

	public function testCanProcessData() {
		$newUserId = $this->_form->process($this->_data);
		$userMapper = new Application_Model_UserMapper();
		$user	   = $userMapper->find($newUserId);
		$this->assertInstanceOf('Application_Model_User', $user);

		
		$this->_data['email'] = 'noEmail';
		$this->assertFalse($this->_form->process($this->_data));
	}

	private function createHash() {
		$csrf = $this->_form->getElement('ds_hash');
		$hash = $csrf->getHash();
		$csrf->initCsrfToken();
		$csrf->initCsrfValidator();
		return $hash;
	}

}