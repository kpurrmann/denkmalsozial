<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initDoctype()
	{
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('HTML5');
	}

	public function _initTranslation()
	{
		$language = 'de_DE';

		$translator = new Zend_Translate
				(
				'array',
				APPLICATION_PATH . '/resources/languages', $language,
				array('scan' => Zend_Translate::LOCALE_DIRECTORY)
		);

		Zend_Validate_Abstract::setDefaultTranslator($translator);
	}

}

