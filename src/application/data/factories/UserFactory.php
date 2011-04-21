<?php

namespace Application\Data\Factory;
use Application\Domain\Contract\IUserFactory;
use Application\Domain\Object as DomainObject;

class UserFactory implements IUserFactory
{
	public static function createUser(
		$firstname,
		$lastname,
		$email,
		$phoneOffice,
		$phoneMobile,
		$phoneFax,
		$login,
		$role,
		$isActive)
	{
		
	}
}