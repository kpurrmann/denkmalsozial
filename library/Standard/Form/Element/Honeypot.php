<?php

/**
 * Description of Honeypot
 *
 * @author Kevin Purrmann
 */
class Standard_Form_Element_Honeypot extends Zend_Form_Element_Text
{

	/**
	 * Constructor
	 *
	 *
	 * @param  string|array|Zend_Config $spec
	 * @param  array|Zend_Config $options
	 * @return void
	 */
	public function __construct($spec, $options = null)
	{
		parent::__construct($spec, $options);

		$this->setAllowEmpty(true)
			->addValidator(new Zend_Validate_StringLength(array(
					'min' => 0,
					'max' => 0
				)));
	}

}

