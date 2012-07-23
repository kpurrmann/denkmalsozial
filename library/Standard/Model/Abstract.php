<?php

/**
 * Description of Model
 *
 * @author Kevin Purrmann
 */
class Standard_Model_Abstract implements Standard_Model_Interface
{

	protected $_mapper;

	public function __construct(array $options = null)
	{

		if (is_array($options)) {
			$this->setOptions($options);
		}
	}

	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
	}

	protected function setMapper($mapper)
	{
		$this->_mapper = $mapper;
		return $this;
	}

	/**
	 * Returns current Mapper
	 * @return Standard_Mapper
	 * */
	public function getMapper()
	{
		if (is_string($this->_mapper)) {
			$this->setMapper(new $this->_mapper());
		}
		return $this->_mapper;
	}

}

?>
