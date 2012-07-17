<?php

class UserController extends Zend_Controller_Action {

	public function indexAction() {
		$this->view->form = new Application_Form_Register();
	}

	public function registerAction() {
		// action body
	}

	public function activateAction() {
		// action body
	}

}

