<?php

/**
 * Description of Abstract
 *
 * @author Kevin Purrmann
 */
class Standard_Mapper_AbstractTest extends ControllerTestCase {

	public function testCanCreateAbstractClass() {
		$stub = $this->getMockForAbstractClass('Standard_Mapper_Abstract');
		$stub->expects($this->any())
			 ->method('getDbTable')
		     ->will($this->returnValue(NULL));

		$this->assertNull($stub->getDbTable());
	}

}

?>
