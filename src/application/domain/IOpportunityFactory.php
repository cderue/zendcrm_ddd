<?php

/**
 * @namespace
 */
namespace Application\Domain\Contract;
use \Application\Domain\Object as DomainObject;

interface IOpportunityFactory
{
	public function createOpportunity(array $options);
}