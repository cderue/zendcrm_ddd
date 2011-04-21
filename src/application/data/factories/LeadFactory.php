<?php

namespace Application\Data\Factory;
use Application\Domain\Contract\ILeadFactory;
use Application\Domain\Object as DomainObject;

class LeadFactory implements ILeadFactory
{
	public static function createLead(
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
		$status,
		User $creator)
	{
		$lead = new DomainObject\Lead();
		$lead->setFirstname($firstname)
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
						->setCreationDate(new \Zend\Date\Date());
						
		return $lead;
	}
}