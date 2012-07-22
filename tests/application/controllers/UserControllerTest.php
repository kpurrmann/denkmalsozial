<?php

class UserControllerTest extends ControllerTestCase {

	public function testIndexAction() {
		$params = array('action'	 => 'index', 'controller' => 'User', 'module'	 => 'default');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);

		// assertions
		$this->assertModule($urlParams['module']);
		$this->assertController($urlParams['controller']);
		$this->assertAction($urlParams['action']);
	}

	/**
	 * Problem causing because cannot succed isValid-Method of Form
	 * Hash is different
	 * @todo Write Test for Succeed
	 */
	public function testCreateActionFails() {
		$params = array('action'	 => 'create', 'controller' => 'User', 'module'	 => 'default');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);


		$this->assertModule($urlParams['module']);
		$this->assertController($urlParams['controller']);
		$this->assertAction($urlParams['action']);
	}



	public function testActivateActionIfNoHashIsSet() {
		$params = array('action'	 => 'activate', 'controller' => 'User', 'module'	 => 'default');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);

		$this->assertRedirect('/');
	}

	public function testActivateActionWithTrueHash() {
		$params = array('action'	 => 'activate', 'controller' => 'User', 'module'	 => 'default', 'hash'	   => 'myHash4');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);
		$this->assertEquals('myHash4', $this->getRequest()->getParam('hash'));

		$userMapper = new Application_Model_UserMapper();
		$user = $userMapper->findOne(array('hash=?' => $this->getRequest()->getParam('hash')));
		$this->assertEquals('1', $user->getActive());
	}

	public function testActivateActionWithFalseHash() {
		$params = array('action'	 => 'activate', 'controller' => 'User', 'module'	 => 'default', 'hash'	   => 'falseHash');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);
		$this->assertEquals('falseHash', $this->getRequest()->getParam('hash'));

		// assertions
		$this->assertModule($urlParams['module']);
		$this->assertController($urlParams['controller']);
		$this->assertAction($urlParams['action']);
	}

	private function createHash() {
		$csrf = $this->_form->getElement('ds_hash');
		$hash = $csrf->getHash();
		$csrf->initCsrfToken();
		$csrf->initCsrfValidator();
		return $hash;
	}

}

