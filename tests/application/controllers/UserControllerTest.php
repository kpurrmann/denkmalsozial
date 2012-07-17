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

	public function testRegisterAction() {
		$params = array('action'	 => 'register', 'controller' => 'User', 'module'	 => 'default');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);

		// assertions
		$this->assertModule($urlParams['module']);
		$this->assertController($urlParams['controller']);
		$this->assertAction($urlParams['action']);
	}

	public function testActivateAction() {
		$params = array('action'	 => 'activate', 'controller' => 'User', 'module'	 => 'default');
		$urlParams   = $this->urlizeOptions($params);
		$url		 = $this->url($urlParams);
		$this->dispatch($url);

		// assertions
		$this->assertModule($urlParams['module']);
		$this->assertController($urlParams['controller']);
		$this->assertAction($urlParams['action']);
	}

}

