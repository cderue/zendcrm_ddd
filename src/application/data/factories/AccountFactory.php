<?php
/**
 * @namespace
 */
namespace Application\Data\Factory;
use Application\Domain\Contract\IAccountFactory;
use Application\Domain\Object as DomainObject;

/**
 * Fabrique de comptes clients
 */
class AccountFactory implements IAccountFactory
{
	/**
	 * Fabriquer un compte client
	 * @param unknown_type $id
	 * @param unknown_type $name
	 * @param unknown_type $phoneOffice
	 * @param unknown_type $phoneFax
	 * @param unknown_type $address
	 * @param unknown_type $creator
	 * @param unknown_type $creationDate
	 */
	public static function createAccount(
		$id = null,
		$name, 
		$phoneOffice, 
		$phoneFax, 
		$address, 
		$creator,
		$creationDate)
	{
		$account = new DomainObject\Account();
		$account->setId($id)
						->setName($name)
						->setPhoneOffice($phoneOffice)
						->setPhoneFax($phoneFax)
						->setAddress($address)
						->setCreator($creator)
						->setCreationDate($creationDate);
						
		return $account;
	}
}