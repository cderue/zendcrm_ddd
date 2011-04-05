<?php

use \Application\Domain\Factory as Factory;
use \Application\Domain\Object as DomainObject;

class TestLeadRepository implements Factory\ILeadRepository
{
	private $_store = array();
	
	public function __construct()
	{
		// Crée un premier prospect
		$leadOne = new DomainObject\Lead();
		$leadOne->setFirstname('Caroline')
						->setLastname('Durdan')
						->setEmail('caroline.durdan@pharmacie-gv.com')
						->setAccount('Pharmacie du Grand Vallon')
						->setPhoneOffice('0418228990')
						->setStatus('1')
						->setCreator('admin');
	
		// Crée un autre prospect
		$leadOther = new DomainObject\Lead();
		$leadOther->setFirstname('Edouard')
							->setLastname('Parège')
							->setEmail('edouard.parege@itservices.com')
							->setAccount('IT Services')
							->setPhoneOffice('0116278001')
							->setStatus('1')
							->setCreator('admin');
							
		$this->_store[] = $leadOne;
		$this->_store[] = $leadOther;
	}
	
	public function getLeads()
	{
		return $this->_store;
	}
	
  public function getLeadById($id)
  {
  	foreach ($this->_store as $lead) {
  		if ($id === $lead->getId()) {
  			return $lead;
  		}
  	}
  	return false;
  }
	
  public function getLeadsByCreatorId($creatorId)
  {
  	$result = false;
  	foreach ($this->_store as $lead) {
  		if ($creator === $lead->getCreator()) {
  			$result[] = $lead;
  		}
  	}
  	return $result;
  }
  
  public function addLead(DomainObject\Lead $lead)
  {
  	throw new \Exception('Implementation missing');
  }
	
  public function modifyLead(DomainObject\Lead $lead)
  {
  	throw new \Exception('Implementation missing');
  }
  
  public function removeLead(DomainObject\Lead $lead)
  {
  	throw new \Exception('Implementation missing');
  }
}