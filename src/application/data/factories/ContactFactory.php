<?php

namespace Application\Data\Factory;
use Application\Domain\Contract\IContactFactory;
use Application\Domain\Object as DomainObject;

class ContactFactory implements IContactFactory
{
	public static function createContact(
		$firstname,
		$lastname,
		Account $account,
		$jobTitle,
		$department,
		$email,
		$phoneOffice,
		$phoneMobile,
		$phoneFax,
		Address $address,
		User $creator)
	{
		$contact = new DomainObject\Contact();
		$contact->setFirstname($firstname)
						->setLastname($lastname)
						->setAccount($account)
						->setJobTitle($jobTitle)
						->setDepartment($department)
						->setPhoneOffice($phoneOffice)
						->setPhoneMobile($phoneMobile)
						->setPhoneFax($phoneFax)
						->setAdsress($address)
						->setCreator($user)
						->setCreationDate(new \Zend\Date\Date());
						
		return $contact;
	}
}