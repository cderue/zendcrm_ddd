<?php
/**
 * @namespace
 */
namespace Application\Data\Factory;
use Application\Domain\Contract\IContactFactory;
use Application\Domain\Object as DomainObject;

/**
 * Fabrique de contacts
 */
class ContactFactory implements IContactFactory
{
	/**
	 * Fabriquer un contact
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
	 * @param unknown_type $creator
	 * @param unknown_type $creationDate
	 */
	public static function createContact(
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
		$creator,
		$creationDate)
	{
		$contact = new DomainObject\Contact();
		$contact->setId($id)
						->setFirstname($firstname)
						->setLastname($lastname)
						->setAccount($account)
						->setJobTitle($jobTitle)
						->setDepartment($department)
						->setPhoneOffice($phoneOffice)
						->setPhoneMobile($phoneMobile)
						->setPhoneFax($phoneFax)
						->setAdsress($address)
						->setCreator($creator)
						->setCreationDate($creationDate);
						
		return $contact;
	}
}