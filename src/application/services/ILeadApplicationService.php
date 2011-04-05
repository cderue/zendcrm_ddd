<?php
/**
 * @namespace
 */
namespace Application\Service;
use \Application\Domain\Object as DomainObject;

/**
 * Interface ILeadApplicationService
 */
interface ILeadApplicationService
{
	public function getLeads();
	public function getLeadById($id, DomainObject\Lead $lead);
	public function getLeadsByOwnerId($ownerId);
	public function addLead(DomainObject\Lead $lead);
	public function modifyLead(DomainObject\Lead $lead);
	public function removeLead(DomainObject\Lead $lead);
}