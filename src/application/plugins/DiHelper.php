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
		$container = new \sfServiceContainerBuilder();
		$loader = new \sfServiceContainerLoaderFileXml($container);
		$loader->load(APPLICATION_PATH . '/configs/symfonydi.xml');
		
		return $container;
  }
	
  /**
   * Exécuter l'aide d'action
   */
	public function direct()
	{
		return $this->_getContainer(); 
	}
}