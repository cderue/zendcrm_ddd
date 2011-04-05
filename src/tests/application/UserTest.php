<?php

use \Application\Data\Repository as Repository;

class UserTest extends PHPUnit_Framework_TestCase
{
	private $_userRepository = null;
	
	function setUp()
	{
		$this->_userRepository = new Repository\TestUserRepository();
	}
	
	public function testIfLoginExists()
	{
		
	}
	
	public function testIfLoginNotExists()
	{
		
	}
}