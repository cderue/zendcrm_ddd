<?php

/**
 * @namespace
 */
namespace Application\Domain\Contract;
use \Application\Domain\Object as DomainObject;

interface IAccountFactory
{
	public function createLead(array $options);
}