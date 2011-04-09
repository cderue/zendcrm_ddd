<?php
/**
 * Conteneur d'injection de dépendance
 */

namespace Application\Plugin;


class DiContainer extends \sfServiceContainer
{
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
	static protected $_shared = array();
 
	protected function getEntityContextService()
	{
		if (isset(self::$_shared['entity_context']))
    {
      return self::$_shared['entity_context'];
    }
    
    $class = $this->parameters['entity.context.class'];
    $service = new $class(
    	array(
				'dbname'   => 'zendcrm',
				'username' => '',
				'password' => ''
			)
    );
   
    return self::$_shared['lead_converter_domain'] = $service;		
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
  protected function getLeadConverterDomainService()
  {
    if (isset(self::$_shared['lead_converter_domain']))
    {
      return self::$_shared['lead_converter_domain'];
    }
 		// 
    $class = $this->parameters['domain.leadconverter.class'];
    $service = new $class();
   
    return self::$_shared['lead_converter_domain'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getUserRepositoryService()
  {
  	if (isset(self::$_shared['user_repository']))
    {
      return self::$_shared['user_repository'];
    }
    //
    $class = $this->parameters['repository.user.class'];
    $service = new $class($this->getService('entity_context'));
   
    return self::$_shared['user_repository'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getLeadRepositoryService()
  {
  	if (isset(self::$_shared['lead_repository']))
    {
      return self::$_shared['lead_repository'];
    }
    //
    $class = $this->parameters['repository.lead.class'];
    $service = new $class($this->getService('entity_context'));
   
    return self::$_shared['lead_repository'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getContactRepositoryService()
  {
  	if (isset(self::$_shared['contact_repository']))
    {
      return self::$_shared['contact_repository'];
    }
    //
    $class = $this->parameters['repository.contact.class'];
    $service = new $class($this->getService('entity_context'));
   
    return self::$_shared['contact_repository'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getAccountRepositoryService()
  {
  	if (isset(self::$_shared['account_repository']))
    {
      return self::$_shared['acccount_repository'];
    }
    //
    $class = $this->parameters['repository.account.class'];
    $service = new $class($this->getService('entity_context'));
   
    return self::$_shared['account_repository'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getOpportunityRepositoryService()
  {
  	if (isset(self::$_shared['opportunity_repository']))
    {
      return self::$_shared['opportunity_repository'];
    }
    //
    $class = $this->parameters['repository.opportunity.class'];
    $service = new $class($this->getService('entity_context'));
   
    return self::$_shared['opportunity_repository'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getUserApplicationService()
  {
  	if (isset(self::$_shared['user_application']))
    {
      return self::$_shared['user_application'];
    }
    //
    $class = $this->parameters['application.user.class'];
    $service = new $class(
    	$this->getService('user_repository')
    );
   
    return self::$_shared['user_application'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected  function getContactApplicationService()
  {
  	if (isset(self::$_shared['contact_application']))
    {
      return self::$_shared['contact_application'];
    }
    //
    $class = $this->parameters['application.contact.class'];
    $service = new $class(
    	$this->getService('contact_repository')
    );
   
    return self::$_shared['contact_application'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getLeadApplicationService()
  {
  	if (isset(self::$_shared['lead_application']))
    {
      return self::$_shared['lead_application'];
    }
    //
    $class = $this->parameters['application.lead.class'];
    $service = new $class(
    	$this->getService('leadconverter_domain'),
    	$this->getService('lead_repository')
    );
   
    return self::$_shared['lead_application'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getAccountApplicationService()
  {
  	if (isset(self::$_shared['account_application']))
    {
      return self::$_shared['account_application'];
    }
    //
    $class = $this->parameters['application.account.class'];
    $service = new $class(
    	$this->getService('account_repository')
    );
   
    return self::$_shared['account_application'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getOpportunityApplicationService()
  {
  	if (isset(self::$_shared['opportunity_application']))
    {
      return self::$_shared['opportunity_application'];
    }
    //
    $class = $this->parameters['application.opportunity.class'];
    $service = new $class(
    	$this->getService('opportunity_repository')
    );
   
    return self::$_shared['opportunity_application'] = $service;
  }
}