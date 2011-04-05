<?php

/**
 * @namespace
 */
namespace Application\Domain\Factory;
use \Application\Domain\Object as DomainObject;

interface IOpportunityFactory
{
	public function createOpportunity(array $options);
}