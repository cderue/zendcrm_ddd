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
	//public function getLeads();
	public function getLeadById($id);
	public function getLeadsByCreatorId($creatorId);
	public function addLead(DomainObject\Lead $lead);
	public function modifyLead(DomainObject\Lead $lead);
	public function removeLead(DomainObject\Lead $lead);
}