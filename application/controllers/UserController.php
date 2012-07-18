<?php

class UserController extends Zend_Controller_Action {

	public function indexAction() {
		$this->view->form = new Application_Form_Register();
	}

	public function registerAction() {

		$request = $this->getRequest();
		$form	= new Application_Form_Register();
		if (!$form->process($request->getPost())) {
			$this->view->form = $form;
			return false;
		}

		$this->view->msg = 'Erfolgreich';
		return true;
	}

	public function activateAction() {
		if (!$this->_request->getParam('hash')) {
			$this->_redirect('/');
		}

		$hash	   = $this->_request->getParam('hash');
		$userMapper = new Application_Model_UserMapper();

		if ($user = $userMapper->findByHash($hash)) {
			$user->setActive('1');
			$userMapper->save($user);
		} else {
			$this->_redirect('/', array('notice', 'No hash found in Url'));
		}
	}

}