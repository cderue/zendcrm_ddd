<?php
/**
 * @namespace
 */
namespace Application\Plugin;

class Authorization extends \Zend\Controller\Plugin\AbstractPlugin
{
  protected $_acl = null;
    
  public function __construct() 
  {
    $acl = new \Zend\Acl\Acl();
    // create the user role
    $acl->addRole(new \Zend\Acl\Role('user'));
    // create the admin role, which inherits all of the user's permissions
    $acl->addRole(new \Zend\Acl_\Role('admin'), 'user');
    // add a new resource
    $acl->add(new \Zend\Acl\Resource('sales'));
    $acl->add(new \Zend\Acl\Resource('admin'));
    // set access rules
    $acl->allow('admin', 'admin');
    $acl-> allow('user', 'sales');
    $acl->deny('user', 'admin');
    
    $this->_acl = $acl;
  }  
    
  public function routeShutdown(\Zend\Controller\Request\AbstractRequest $request)
  {
    $resource = $request->getControllerName();
    $auth = new \Zend\Authentication\AuthenticationService();
    if ($auth->hasIdentity()) {
      $identity = $auth->getIdentity();
      var_dump($identity);
      //if (!$this->_acl->isAllowed('guest', 'cms')) {
      //  throw new \Exception('Vous ne disposez pas des droits nécessaires.');
      //}
    } 
  }
}