<?php

/**
 * @namespace
 */
namespace Application\Domain\Factory;
use \Application\Domain\Object as DomainObject;

interface IAccountFactory
{
	public function createLead(array $options);
}