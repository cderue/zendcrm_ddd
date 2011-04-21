<?php

/**
 * @namespace
 */
namespace Application\Domain\Contract;
use \Application\Domain\Object as DomainObject;

interface IContactFactory
{
	public function createContact(array $options);
}