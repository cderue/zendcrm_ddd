<?php
/**
 * @namespace
 */
namespace Application\Data\Factory;
use Application\Domain\Contract\IOpportunityFactory;
use Application\Domain\Object as DomainObject;

/**
 * Fabrique d'opportunités
 */
class OpportunityFactory implements IOpportunityFactory
{
	/**
	 * Fabriquer une opportunité
	 * @param unknown_type $id
	 * @param unknown_type $name
	 * @param unknown_type $account
	 * @param unknown_type $amount
	 * @param unknown_type $dateClosed
	 * @param unknown_type $probability
	 * @param unknown_type $status
	 * @param unknown_type $contact
	 * @param unknown_type $creator
	 * @param unknown_type $creationDate
	 */
	public static function createOpportunity(
		$id = null,
		$name,
		$account,
		$amount,
		$dateClosed,
		$probability,
		$status,
		$contact,
		$creator,
		$creationDate)
	{
		$opportunity = new DomainObject\Opportunity();
		$opportunity->setId($id)
								->setName($name)
								->setAccount($account)
								->setAmount($amount)
								->setDateClosed($dateClosed)
								->setProbability($probability)
								->setStatus($status)
								->setContact($contact)
								->setCreator($creator)
								->setCreationDate($creationDate);
								
		return $opportunity;
	}
}