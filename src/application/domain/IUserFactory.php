<?php

/**
 * @namespace
 */
namespace Application\Domain\Contract;
use \Application\Domain\Object as DomainObject;

interface IUserFactory
{
	public function createUser(array $options);
}