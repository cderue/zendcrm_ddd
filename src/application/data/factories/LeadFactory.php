<?php
/**
 * @namespace
 */
namespace Application\Data\Factory;
use Application\Domain\Contract\ILeadFactory;
use Application\Domain\Object as DomainObject;

/**
 * Fabrique de prospects
 */
class LeadFactory implements ILeadFactory
{
	/**
	 * Fabriquer un prospect
	 * @param unknown_type $id
	 * @param unknown_type $firstname
	 * @param unknown_type $lastname
	 * @param unknown_type $account
	 * @param unknown_type $jobTitle
	 * @param unknown_type $department
	 * @param unknown_type $email
	 * @param unknown_type $phoneOffice
	 * @param unknown_type $phoneMobile
	 * @param unknown_type $phoneFax
	 * @param unknown_type $address
	 * @param unknown_type $status
	 * @param unknown_type $creator
	 * @param unknown_type $creationDate
	 */
	public static function createLead(
		$id = null,
		$firstname,
		$lastname,
		$account,
		$jobTitle,
		$department,
		$email,
		$phoneOffice,
		$phoneMobile,
		$phoneFax,
		$address,
		$status,
		$creator,
		$creationDate)
	{
		$lead = new DomainObject\Lead();
		$lead->setId($id)
				 ->setFirstname($firstname)
				 ->setLastname($lastname)
				 ->setAccount($account)
				 ->setJobTitle($jobTitle)
				 ->setDepartment($department)
				 ->setPhoneOffice($phoneOffice)
				 ->setPhoneMobile($phoneMobile)
				 ->setPhoneFax($phoneFax)
				 ->setAdsress($address)
				 ->setStatus($status)
				 ->setCreator($creator)
				 ->setCreationDate($creationDate);
						
		return $lead;
	}
}