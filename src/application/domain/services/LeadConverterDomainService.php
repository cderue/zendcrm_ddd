<?php
/**
 * @namespace
 */
namespace Application\Domain\Service;

/**
 * Service de conversion des prospects
 */
class LeadConverterDomainService implements ILeadConverterDomainService
{
  /**
   * Créer un nouveau contact à partir d'un prospect
   * @param DomainObject\Lead $lead
   * @param DomainObject\Contact $contact
   */	
  public function performConversionToContact()
  {	
    /*$account->setName($lead->getAccount());
  	$account->setCreator($lead->getCreator());
    
  	$contact->setId($lead->getId());
    $contact->setFirstname($lead->getFirstname());
    $contact->setLastname($lead->getLastname());
    $contact->setAccount($account);
    $contact->setJobTitle($lead->getJobTitle());
    $contact->setDepartment($lead->getDepartment());
    $contact->setEmail($lead->getEmail());
    $contact->setPhoneOffice($lead->getPhoneOffice());
    $contact->setPhoneMobile($lead->getPhoneMobile());
    $contact->setPhoneFax($lead->getPhoneFax());
    $contact->setAddress($lead->getAddress());
    $contact->setCreator($lead->getCreator());
    
    $opportunity->setName($this->_opportunityName);
    $opportunity->setDateClosed($this->_opportunityDateClosed);*/
  }
  
  public function performConversionToAccount()
  {
  	
  }
  
  public function performConversionToOpportunity()
  {
  	
  }
}