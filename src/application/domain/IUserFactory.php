<?php

/**
 * @namespace
 */
namespace Application\Domain\Factory;
use \Application\Domain\Object as DomainObject;

interface IUserFactory
{
	public function createUser(array $options);
}