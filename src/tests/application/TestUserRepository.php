<?php

use \Application\Domain\Factory as Factory;
use \Application\Domain\Object as DomainObject;

class TestUserRepository implements Factory\IUserRepository
{
	private $_store = array();
	
	public function __construct()
	{
		// Crée un administrateur
		$admin = new DomainObject\User();
		$admin->setFirstname('Admin')
					->setLastname('Admin')
					->setEmail('admin@zendcrm.com')
					->setLogin('admin')
					->setPasswordHash(md5('admin'))
					->setRole('ADM')
					->setIsActive(true)
					->setCreator('admin');
	
		// Crée un utilisateur normal
		$user = new DomainObject\User();
		$user->setFirstname('Cédric')
				 ->setLastname('Derue')
				 ->setEmail('cedric.derue@zendcrm.com')
				 ->setLogin('cderue')
				 ->setPasswordHash(md5('cderue'))
				 ->setRole('STD')
				 ->setIsActive(true)
				 ->setCreator('admin');

		$this->_store[] = $admin;
		$this->_store[] = $user;
	}
	
	public function getUsers()
	{
		return $this->_store;
	}
	
  public function getUserById($id)
  {
  	foreach ($this->_store as $user) {
  		if ($id === $user->getId()) {
  			return $user;
  		}
  	}
  	return false;
  }
  
 public function getUsersByCreatorId($creatorId)
  {
  	$result = false;
  	foreach ($this->_store as $user) {
  		if ($creator === $user->getCreator()) {
  			$result[] = $user;
  		}
  	}
  	return $result;
  }
  
	public function getUsersByOwnerId($creator)
	{
		throw new \Exception('Implementation missing');
	}
	
  public function addUser(DomainObject\User $user)
  {
  	throw new \Exception('Implementation missing');
  }
  
	public function modifyUser(DomainObject\User $user)
	{
		throw new \Exception('Implementation missing');
	}
	
  public function removeUser(DomainObject\User $user)
  {
  	throw new \Exception('Implementation missing');
  }
}