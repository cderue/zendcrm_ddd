<?php
/**
 * @namespace
 */
namespace Application\Service;
use \Application\Domain\Object as DomainObject;

/**
 * Interface IOpportunityApplicationService
 */
interface IOpportunityApplicationService
{
	public function getOpportunities();
	public function getOpportunityById($id, DomainObject\Opportunity $opportunity);
	public function getOpportunitiesByOwnerId($ownerId);
	public function addOpportunity(DomainObject\Opportunity $opportunity);
	public function modifyOpportunity(DomainObject\Opportunity $opportunity);
	public function removeOpportunity(DomainObject\Opportunity $opportunity);
}