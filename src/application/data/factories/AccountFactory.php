<?php

namespace Application\Data\Factory;
use Application\Domain\Contract\IAccountFactory;
use Application\Domain\Object as DomainObject;

class AccountFactory implements IAccountFactory
{
	public static function createAccount(
		$name, 
		$phoneOffice, 
		$phoneFax, 
		DomainObject\Address $address, 
		DomainObject\User $creator)
	{
		$account = new DomainObject\Account();
		$account->setName($name)
						->setPhoneOffice($phoneOffice)
						->setPhoneFax($phoneFax)
						->setAddress($address)
						->setCreator($creator)
						->setCreationDate(new \Zend\Date\Date());
						
		return $account;
	}
}