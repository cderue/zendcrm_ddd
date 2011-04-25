<?php
/**
 * @namespace
 */
namespace Application\Data\Factory;
use Application\Domain\Contract\IUserFactory;
use Application\Domain\Object as DomainObject;

/**
 * Fabrique d'utilisateurs
 */
class UserFactory implements IUserFactory
{
	/**
	 * Fabrique un utilisateur
	 * @param unknown_type $id
	 * @param unknown_type $firstname
	 * @param unknown_type $lastname
	 * @param unknown_type $email
	 * @param unknown_type $phoneOffice
	 * @param unknown_type $phoneMobile
	 * @param unknown_type $phoneFax
	 * @param unknown_type $login
	 * @param unknown_type $role
	 * @param unknown_type $isActive
	 * @param unknown_type $creator
	 * @param unknown_type $creationDate
	 */
	public static function createUser(
		$id = null,
		$firstname,
		$lastname,
		$email,
		$phoneOffice,
		$phoneMobile,
		$phoneFax,
		$login,
		$role,
		$isActive,
		$creator,
		$creationDate)
	{
		$user = new DomainObject\User();
		$user->setId($id)
				 ->setFirstname($firstname)
				 ->setLastname($lastname)
				 ->setEmail($email)
				 ->setPhoneOffice($phoneOffice)
				 ->setPhoneMobile($phoneMobile)
				 ->setPhoneFax($phoneFax)
				 ->setLogin($login)
				 ->setRole($role)
				 ->setIsActive($isActive)
				 ->setCreator($creator)
				 ->setCreationDate($creationDate);
				 
		return $user;
	}
}