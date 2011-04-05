<?php

/**
 * @namespace
 */
namespace Application\Domain\Factory;
use \Application\Domain\Object as DomainObject;

interface IContactFactory
{
	public function createContact(array $options);
}