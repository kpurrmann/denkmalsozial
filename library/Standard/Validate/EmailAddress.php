<?php

/**
 * Description of EmailAddress
 *
 * @author Kevin Purrmann
 */
class Standard_Validate_EmailAddress extends Zend_Validate_EmailAddress
{

	/**
	 * @var array
	 */
	protected $_messageTemplates = array(
		self::INVALID			=> "Ungültiger Typ. String erwartet.",
		self::INVALID_FORMAT	 => "'%value%' ist keine gültige E-Mail-Adresse.",
		self::INVALID_HOSTNAME   => "'%hostname%' ist kein gültiger Providername für '%value%'",
		self::INVALID_MX_RECORD  => "'%hostname%' scheint keinen gültigen MX-Eintrag zu besitzen für den Wert '%value%'",
		self::INVALID_SEGMENT	=> "'%hostname%' kann nicht weitergeleitet werden.",
		self::DOT_ATOM		   => "'%localPart%' ihre Länderangabe ist falsch.",
		self::QUOTED_STRING	  => "'%localPart%' kann nicht geprüft werden.",
		self::INVALID_LOCAL_PART => "'%localPart%' ist kein gültiger Eintrag '%value%'",
		self::LENGTH_EXCEEDED	=> "'%value%' ist zu lang für eine E-Mail-Adresse.",
	);

}

?>
