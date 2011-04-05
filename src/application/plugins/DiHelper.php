<?php
/**
 * @namespace
 */
namespace Application\Plugin;

/**
 * Aide d'action pour l'injection de dépendance
 */
class DiHelper extends \Zend\Controller\Action\Helper\AbstractHelper
{    
	/**
	 * Obtenir le conteneur d'injection de dépendance
	 */
	private function _getContainer()
	{
    $container = new DiContainer(
    	array(
  			'domain.leadconverter.class' => '\Application\Domain\Service\LeadConverterDomainService',
  			'repository.user.class' => '\Application\Repository\UserRepository',
  			'repository.contact.class'    => '\Application\Repository\ContactRepository',
    		'repository.lead.class' => '\Application\Repository\LeadRepository',
    		'repository.account.class' => '\Application\Repository\AccountRepository',
    		'repository.opportunity.class' => '\Application\Repository\OpportunityRepository',
    		'application.user.class' => '\Application\Service\UserApplicationService',
    		'application.contact.class' => '\Application\Service\ContactApplicationService',
    		'application.lead.class' => '\Application\Service\LeadApplicationService',
    		'application.account.class' => '\Application\Service\AccountApplicationService',
    		'application.opportunity.class' => '\Application\Service\OpportunityApplicationService'
			)
		);
  }
	
  /**
   * Exécuter l'aide d'action
   */
	public function direct()
	{
		return $this->_getContainer(); 
	}
}