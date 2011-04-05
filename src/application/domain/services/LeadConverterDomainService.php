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
   * 
   * Enter description here ...
   * @var unknown_type
   */
	private $_opportunityName;
  /**
   * 
   * Enter description here ...
   * @var unknown_type
   */
  private $_opportunityDateClosed;
  
  /**
   * Constructeur
   * @param string $opportunityName
   * @param string $opportunityDateClosed
   */
	public function __construct($opportunityName, $opportunityDateClosed)
  {
  	$this->_opportunityName = $opportunityName;
  	$this->_opportunityDateClosed = $opportunityDateClosed;
  }
  
  /**
   * Créer un nouveau contact à partir d'un prospect
   * @param DomainObject\Lead $lead
   * @param DomainObject\Contact $contact
   */	
  public function performConversionToContact(
    DomainObject\Lead $lead,
    DomainObject\Contact $contact,
    DomainObject\Account $account,
    DomainObject\Opportunity $opportunity)
  {	
    $account->setName($lead->getAccount());
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
    $opportunity->setDateClosed($this->_opportunityDateClosed);
  }
}