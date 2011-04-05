<?php

namespace Application\Data\Factory;
use Application\Domain\Factory as Factory;
use Application\Domain\Repository as Repository;

class OpportunityFactory implements IOpportunityFactory
{
	private $_accountRepository = null;
	private $_contactRepository = null;
	
	public function __construct(
		Repository\IAccountRepository $accountRepository,
		Repository\IContactRepository $contactRepository)
	{
		
	}
	
	public function createOpportunity(array $options)
	{
		
	}
	
	private function _checkOptions(array $options)
	{
		
	}
}