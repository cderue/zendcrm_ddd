<?php

use MongoEntity\IUnitOfWork;

class UserContext implements IUnitOfWork
{
	private $_store = array();
	private $_identityMap = array();
	private $_added = array();
	private $_updated = array();
	private $_deleted = array();
	
	public function addEntity($user)
	{
		$uid = spl_object_hash($user);
		$this->_identityMap[$uid] = $user;
		$this->_added[$uid] = $user;
	}
	
	public function updateEntity($user)
	{
		$this->_updated[$user->getId()] = $user;
	}
	
	public function deleteEntity($user)
	{
		$this->_deleted[$user->getId()] = $user;
	}
	
	public function attachEntity($user)
	{
		
	}
	
	public function detachEntity($entity)
	{
		
	}
	
	public function persist()
	{
		foreach ($this->_added as $key => $add) {
			$this->_store[$key] = $add;
		}
		
		foreach ($this->_updated as ) {
			
		}
		
		foreach () {
			
		}
	}
	
	public function clean()
	{
		
	}
}