<?php

namespace Application\Plugin;

class Authentication extends \Zend\Controller\Plugin\AbstractPlugin
{    
  public function preDispatch(\Zend\Controller\Request\AbstractRequest $request)
  {
    $auth = new \Zend\Authentication\AuthenticationService();   
    if (!$auth->hasIdentity()) {
      if (!in_array($request->getControllerName(), array('user', 'error'))) {
        $request->setControllerName('user')
                ->setActionName('login')
                ->setDispatched(false);
        return;
      }
    }
  }
}
