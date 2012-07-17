<?php

/**
 * UserMapperTest
 *
 * @author Kevin Purrmann
 */
class Application_Model_UserMapperTest extends MapperTestCase {

	protected $_initialSeedFile = 'users.xml';

	public function testCanCreateUserMapper() {
		$userMapper = new Application_Model_UserMapper();
		$this->assertInstanceOf('Application_Model_UserMapper', $userMapper);
	}

	public function testCanFindUser() {
		$userMapper = new Application_Model_UserMapper();
		$user	   = $userMapper->find(1);

		$this->assertInstanceOf('Application_Model_User', $user);
		$this->_dataSet = $this->convertRecordToDataSet($user->toArray(), 'users');
		$this->assertDataSetsMatchXML('usersFoundOne.xml', $this->_dataSet);

		$user = $userMapper->find(999999);
		$this->assertFalse($user);
	}

	public function testCanCreateAndSaveUser() {
		$data = array();
		$data['email']   = 'user6@test.de';
		$data['active']  = false;
		$data['hash']	= 'myHash6';
		$data['created'] = '2012-06-25 20:55:48';
		$userMapper	  = new Application_Model_UserMapper();

		$user = $userMapper->createUser($data);
		$this->assertInstanceOf('Application_Model_User', $user);
		$this->assertEquals($data['email'], $user->getEmail());

		$userId = $userMapper->save($user);
		$this->assertNotEmpty($userId);
		$this->assertEquals(6, $userId);

		$user = $userMapper->find($userId);
		$this->assertInstanceOf('Application_Model_User', $user);
		$this->_dataSet = $this->convertRecordToDataSet($user->toArray(), 'users');
		$this->assertDataSetsMatchXML('usersFoundCreated.xml', $this->_dataSet);

		$this->assertFalse($userMapper->save(new Application_Model_User()));


		unset($data['email']);
		$noUser = $userMapper->createUser($data);
		$this->assertFalse($noUser);
	}

	public function testFindByHash() {
		$userMapper = new Application_Model_UserMapper();
		$user	   = $userMapper->findByHash('myHash1');
		$this->assertInstanceOf('Application_Model_User', $user);
		$this->_dataSet = $this->convertRecordToDataSet($user->toArray(), 'users');
		$this->assertDataSetsMatchXML('usersFoundOne.xml', $this->_dataSet);
	}

	public function testCanCreateHash() {
		$data = array();
		$data['email']   = 'user6@test.de';
		$data['active']  = false;
		$data['created'] = '2012-06-25 20:55:48';
		$userMapper	  = new Application_Model_UserMapper();
		$arrayHashes	 = array();

		$user = $userMapper->createUser($data);
		$this->assertInstanceOf('Application_Model_User', $user);
		$this->assertNotEmpty($user->getHash());

		for ($i = 0; $i < 5; $i++) {
			$user						  = $userMapper->createUser($data);
			$this->assertArrayNotHasKey($user->getHash(), $arrayHashes);
			$arrayHashes[$user->getHash()] = true;
		}
	}

}

?>
