<?php

/**
 * @namespace
 */
namespace Application\Domain\Contract;
use \Application\Domain\Object as DomainObject;

interface ILeadFactory
{
	public function createLead(array $options);
}