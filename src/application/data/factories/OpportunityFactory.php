<?php

namespace Application\Data\Factory;
use Application\Domain\Contract\IOpportunityFactory;
use Application\Domain\Object as DomainObject;

class OpportunityFactory implements IOpportunityFactory
{
	public static function createOpportunity(
		$name,
		DomainObject\Account $account,
		$amount,
		$dateClosed,
		$probability,
		$status,
		DomainObject\Contact $contact,
		DomainObject\User $creator)
	{
		$opportunity = new DomainObject\Opportunity();
		$opportunity->setName($name)
								->setAccount($account)
								->setAmount($amount)
								->setDateClosed($dateClosed)
								->setProbability($probability)
								->setStatus($status)
								->setContact($contact)
								->setCreator($creator)
								->setCreationDate(new \Zend\Date\Date());
								
		return $opportunity;
	}
}