<?php

/**
 * Description of Register
 *
 * @author Kevin Purrmann
 */
class Application_Forms_RegisterTest extends ControllerTestCase {

	public function testCanCreateForm() {
		$form = new Application_Form_Register();

		$this->assertInstanceOf('Zend_Form', $form);
		$this->assertInstanceOf('Application_Form_Register', $form);
		$this->assertEquals('user/register', $form->getAction());
	}

	public function testFormHasElements() {
		$form = new Application_Form_Register();

		$this->assertInstanceOf('Zend_Form_Element_Text', $form->getElement('email'));
		$this->assertInstanceOf('Zend_Form_Element_Text', $form->getElement('msg'));
		$this->assertInstanceOf('Zend_Form_Element_Hash', $form->getElement('ds_hash'));
		$this->assertInstanceOf('Zend_Form_Element_Submit', $form->getElement('submit'));
	}

	public function testFormCanHandleHash() {

		$form = new Application_Form_Register();

		$csrf = $form->getElement('ds_hash');
		$hash = $csrf->getHash();
		$csrf->initCsrfToken();
		$csrf->initCsrfValidator();

		$falseCsrf = new Zend_Form_Element_Hash('false_ds_hash');
		$falseHash = $falseCsrf->getHash();

		$data = array(
		   'email'   => 'newuser@test.de',
		   'msg'	 => '',
		   'ds_hash' => $hash,
		   'submit'  => 'submit',
		);
		$this->assertTrue($form->isValid($data));

		$falseData = array(
		   'email'   => 'newuser@test.de',
		   'msg'	 => '',
		   'ds_hash' => $falseHash,
		   'submit'  => 'submit',
		);
		$this->assertFalse($form->isValid($falseData));
	}

	public function testFormCanHandleEmail(){
		$form = new Application_Form_Register();

		$csrf = $form->getElement('ds_hash');
		$hash = $csrf->getHash();
		$csrf->initCsrfToken();
		$csrf->initCsrfValidator();

		$data = array(
		   'email'   => 'newuser@test.de',
		   'msg'	 => '',
		   'ds_hash' => $hash,
		   'submit'  => 'submit',
		);
		$this->assertTrue($form->isValid($data));

		$data = array(
		   'email'   => 'user1test.de',
		   'msg'	 => '',
		   'ds_hash' => $hash,
		   'submit'  => 'submit',
		);
		$this->assertFalse($form->isValid($data));
	}

	public function testFormCanHandleHoneypot(){
		$form = new Application_Form_Register();

		$csrf = $form->getElement('ds_hash');
		$hash = $csrf->getHash();
		$csrf->initCsrfToken();
		$csrf->initCsrfValidator();

		$data = array(
		   'email'   => 'newuser@test.de',
		   'msg'	 => '',
		   'ds_hash' => $hash,
		   'submit'  => 'submit',
		);
		$this->assertTrue($form->isValid($data));

		$data = array(
		   'email'   => 'newuser@test.de',
		   'msg'	 => '1234',
		   'ds_hash' => $hash,
		   'submit'  => 'submit',
		);
		$this->assertFalse($form->isValid($data));
	}

}