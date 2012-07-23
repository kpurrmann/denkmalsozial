<?php

/**
 * UserMapperTest
 *
 * @author Kevin Purrmann
 */
class Application_Model_UserMapperTest extends MapperTestCase
{

	protected $_initialSeedFile = 'users.xml';

	public function testCanCreateUserMapper()
	{
		$userMapper = new Application_Model_UserMapper();
		$this->assertInstanceOf('Standard_Mapper_Abstract', $userMapper);
		$this->assertInstanceOf('Application_Model_UserMapper', $userMapper);
	}

	public function testCanFindUser()
	{
		$userMapper = new Application_Model_UserMapper();
		$user	   = $userMapper->find(1);
		$this->assertInstanceOf('Application_Model_User', $user);
		$userArray  = array(
			'id'	  => $user->getId(),
			'email'   => $user->getEmail(),
			'active'  => $user->getActive(),
			'hash'	=> $user->getHash(),
			'created' => $user->getCreated(),
		);
		$this->_dataSet = $this->convertRecordToDataSet($userArray, 'users');
		$this->assertDataSetsMatchXML('usersFoundOne.xml', $this->_dataSet);

		$user = $userMapper->find(999999);
		$this->assertFalse($user);
	}

	public function testFindOneByHash()
	{
		$userMapper = new Application_Model_UserMapper();
		$where	  = array(
			'hash=?'   => 'myHash1'
		);
		$user	  = $userMapper->findOne($where);
		$this->assertInstanceOf('Application_Model_User', $user);
		$userArray = array(
			'id'	  => $user->getId(),
			'email'   => $user->getEmail(),
			'active'  => $user->getActive(),
			'hash'	=> $user->getHash(),
			'created' => $user->getCreated(),
		);
		$this->_dataSet = $this->convertRecordToDataSet($userArray, 'users');
		$this->assertDataSetsMatchXML('usersFoundOne.xml', $this->_dataSet);

		$userNotFound = $userMapper->findOne(array('hash=?' => 'falseHash'));
		$this->assertFalse($userNotFound);
	}

	public function testFindOneByEmail()
	{
		$userMapper = new Application_Model_UserMapper();
		$user	   = $userMapper->findOne(array('email=?'  => 'user1@test.de'));
		$this->assertInstanceOf('Application_Model_User', $user);
		$userArray = array(
			'id'	  => $user->getId(),
			'email'   => $user->getEmail(),
			'active'  => $user->getActive(),
			'hash'	=> $user->getHash(),
			'created' => $user->getCreated(),
		);
		$this->_dataSet = $this->convertRecordToDataSet($userArray, 'users');
		$this->assertDataSetsMatchXML('usersFoundOne.xml', $this->_dataSet);
	}

	public function testCanSaveUser()
	{

		$userArray = array(
			'email'   => 'user6@test.de',
			'hash'	=> 'myHash6',
			'created' => '2012-06-25 20:55:48'
		);
		$user	 = new Application_Model_User($userArray);
		$userId   = $user->getMapper()->save($user);

		$newUser = $user->getMapper()->find($userId);

		$newUserArray = array(
			'id'	  => 6,
			'email'   => $newUser->getEmail(),
			'active'  => $newUser->getActive(),
			'hash'	=> $newUser->getHash(),
			'created' => $newUser->getCreated(),
		);
		$this->_dataSet = $this->convertRecordToDataSet($newUserArray, 'users');
		$this->assertDataSetsMatchXML('usersFoundCreated.xml', $this->_dataSet);
	}

	public function testCanUpdateUser()
	{
		$userArray = array(
			'id'	=> 5,
			'email'   => 'user5@test.de',
			'hash'	=> 'myHash5',
			'active' => true,
			'created' => '2012-06-25 20:55:48'
		);

		$user = new Application_Model_User($userArray);
		$user->getMapper()->save($user);
		$updatedUser = $user->getMapper()->find(5);
		$this->assertEquals('1',$updatedUser->getActive());
	}

}