<?php

/**
 * Description of Register
 *
 * @author Kevin Purrmann
 */
class Application_Form_Register extends Zend_Form
{

	/**
	 * Init Register Form
	 */
	public function init()
	{

		$this->setAction('/user/create');

		// email element
		$email = new Zend_Form_Element_Text('email');
		$email->addValidator(new Zend_Validate_EmailAddress(true))
			->addValidator(new Zend_Validate_Db_NoRecordExists(array(
					'table' => 'users',
					'field' => 'email'
				)));
		$email->setRequired(TRUE);

		// honeypot element
		$honeypot = new Standard_Form_Element_Honeypot('msg');

		// hash element
		$hash = new Zend_Form_Element_Hash('ds_hash');

		// submit element
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('class', 'btn');

		// Set up form
		$this->addElement($email)
			->addElement($honeypot)
			->addElement($hash)
			->addElement($submit);
	}

	public function process(array $data)
	{
		if ($this->isValid($data)) {
			$user = new Application_Model_User($data);
			return $user->getMapper()->save($user);
		}
		return false;
	}

}

?>
