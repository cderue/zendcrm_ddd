<?php

namespace Application\Data\Factory;
use Application\Domain\Factory as Factory;
use Application\Domain\Repository as Repository;

class ContactFactory implements Factory\IContactFactory
{
	private $_leadRepository = null;
	
	public function __construct(Repository\ILeadRepository $leadRepository)
	{
		
	}
	
	public function createContact(array $options)
	{
		
	}
	
	private function _checkOptions(array $options)
	{
		
	}
}