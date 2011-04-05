<?php
/**
 * @namespace
 */
namespace Application\Domain\Service;
use \Application\Domain\Object as DomainObject;

/**
 * Service de conversion des prospects
 */
interface ILeadConverterDomainService
{
  public function performConversionToContact(DomainObject\Lead $lead, DomainObject\Contact $contact);
  public function performConversionToAccount(DomainObject\Lead $lead, DomainObject\Account $account);
	public function performConversionToOpportunity(DomainObject\Lead $lead, DomainObject\Opportunity $opportunity);
}
