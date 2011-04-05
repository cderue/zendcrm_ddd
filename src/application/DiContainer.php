<?php
/**
 * Conteneur d'injection de dépendance
 */
class DiContainer extends sfServiceContainer
{
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
	static protected $services = array();
 
	protected function getEntityContextService()
	{
		return new \MongoEntity\EntityContext(
			array(
				'dbname'   => 'zendcrm',
				'username' => '',
				'password' => ''
			)
		);		
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
  protected function getLeadConverterDomainService()
  {
    if (isset(self::$services['lead_converter_domain']))
    {
      return self::$services['lead_converter_domain'];
    }
 		// 
    $class = $this->parameters['domain.leadconverter.class'];
    $service = new $class();
   
    return self::$services['lead_converter_domain'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getUserRepositoryService()
  {
  	if (isset(self::$services['user_repository']))
    {
      return self::$services['user_repository'];
    }
    //
    $class = $this->parameters['repository.user.class'];
    $service = new $class();
   
    return self::$services['user_repository'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getLeadRepositoryService()
  {
  	if (isset(self::$services['lead_repository']))
    {
      return self::$services['lead_repository'];
    }
    //
    $class = $this->parameters['repository.lead.class'];
    $service = new $class();
   
    return self::$services['lead_repository'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getContactRepositoryService()
  {
  	if (isset(self::$services['contact_repository']))
    {
      return self::$services['contact_repository'];
    }
    //
    $class = $this->parameters['repository.contact.class'];
    $service = new $class();
   
    return self::$services['contact_repository'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getAccountRepositoryService()
  {
  	if (isset(self::$services['account_repository']))
    {
      return self::$services['acccount_repository'];
    }
    //
    $class = $this->parameters['repository.account.class'];
    $service = new $class();
   
    return self::$services['account_repository'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  public function getOpportunityRepositoryService()
  {
  	if (isset(self::$services['opportunity_repository']))
    {
      return self::$services['opportunity_repository'];
    }
    //
    $class = $this->parameters['repository.opportunity.class'];
    $service = new $class();
   
    return self::$services['opportunity_repository'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getUserApplicationService()
  {
  	if (isset(self::$services['user_application']))
    {
      return self::$services['user_application'];
    }
    //
    $class = $this->parameters['application.user.class'];
    $service = new $class();
   
    return self::$services['user_application'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected  function getContactApplicationService()
  {
  	if (isset(self::$services['contact_application']))
    {
      return self::$services['contact_application'];
    }
    //
    $class = $this->parameters['application.contact.class'];
    $service = new $class();
   
    return self::$services['contact_application'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getLeadApplicationService()
  {
  	if (isset(self::$services['lead_application']))
    {
      return self::$services['lead_application'];
    }
    //
    $class = $this->parameters['application.lead.class'];
    $service = new $class();
   
    return self::$services['lead_application'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getAccountApplicationService()
  {
  	if (isset(services::$shared['account_application']))
    {
      return self::$services['account_application'];
    }
    //
    $class = $this->parameters['application.account.class'];
    $service = new $class();
   
    return self::$services['account_application'] = $service;
  }
  
  /**
   * 
   * Enter description here ...
   */
  protected function getOpportunityApplicationService()
  {
  	if (isset(self::$services['opportunity_application']))
    {
      return self::$services['opportunity_application'];
    }
    //
    $class = $this->parameters['application.opportunity.class'];
    $service = new $class();
   
    return self::$services['opportunity_application'] = $service;
  }
}