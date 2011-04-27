<?php
/**
 * @namespace
 */
namespace Application\Plugin;

class Authorization extends \Zend\Controller\Plugin\AbstractPlugin
{  
  public function preDispatch(\Zend\Controller\Request\AbstractRequest $request)
  {
    $resource = $request->getControllerName();
    $action = $request->getActionName();
    $auth = new \Zend\Authentication\AuthenticationService();
    if ($auth->hasIdentity() 
    	&& $resource != 'error' 
    	&& !in_array($action, array('login', 'logout'))) {
      $identity = $auth->getIdentity();
      if (!$identity->isAllowed(strtoupper($resource))) {
      	$request->setControllerName('user')
                ->setActionName('login')
                ->setDispatched(false);
        return;
    	}
    } 
  }
}