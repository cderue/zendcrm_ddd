<?php
/** 
 * Copyright (c) 2011, Cédric DERUE
 * All rights reserved.
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the University of California, Berkeley nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE REGENTS AND CONTRIBUTORS ``AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE REGENTS AND CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * @namespace
 */
use Application\Form as ApplicationForm;
use Application\Service as ApplicationService;
use ApplicationModel as ApplicationModel;
use Application\Model\Repository as ApplicationRepository; 
 
/**
 * Contôleur d'action pour la gestion des utilisateurs
 */
class UserController extends \Zend\Controller\Action
{
  /**
	 * Service
	 */	
  private $_service = null;
  
  /**
   * Injection
   */
  public function init()
  {
  	$this->setApplicationService($this->broker('DiHelper')->direct()->getService('user_application'));
  }
  
	public function setApplicationService(Service\IUserApplicationService $service)
	{
		$this->_service = $service;
	}
  
  /**
   * Action par défaut
   */
  public function indexAction()
  {
      return $this->_forward('list');
  }
  
  /**
   * Authentifier un utilisateur
   */
  public function loginAction()
  {
    $this->view->broker('layout')->getLayout()->disableLayout();  
    if ($this->_request->isPost()) { 
      $login = $_POST['login'];
      $password = $_POST['password'];
      
      //
      
      $storage = new \Zend\Authentication\Storage\Session();
      $auth = new \Zend\Authentication\AuthenticationService($storage); 
        
      $noSqlDbAdapter = \Zend\Registry::get('nosqldb');
      
      $authAdapter = new \Zendcrm\Authentication\Adapter\NoSqlDb();
      $authAdapter->setNoSqlDbAdapter($noSqlDbAdapter);
      $authAdapter->setCollectionName('users'); 
      $authAdapter->setIdentityProperty('login');
      $authAdapter->setCredentialProperty('password_hash'); 
      $authAdapter->setCredentialTreatment('MD5');
      $authAdapter->setIdentity($login);
      $authAdapter->setCredential(md5($password));
    
      $authResult = $auth->authenticate($authAdapter);   
      if ($authResult->isValid()) {
        
        //\Zend\Session\SessionManager::regenerateId();
//echo $acl->isAllowed('guest', 'cms') ? 'allowed' : 'denied';
        $this->view->broker('layout')->getLayout()->enableLayout();
        $this->_forward('list', 'lead');
      }
      else
      {
        $this->view->form = new \Application\Form\LoginForm();  
        $this->_forward('login', null, null, array('message' => 'Erreur d\'identifiant ou de mot de passe.'));
      }
    } else {
      $this->view->form = new \Application\Form\LoginForm(); 
    }
  }
  
  /**
   * Déconnecter un utilisateur
   */
  public function logoutAction()
  {
    //$authStorage = new \Zend\Authentication\Storage\Session();
    //$authService = new \Zend\Authentication\AuthenticationService($authStorage);
    //$authService->clearIdentity();
    
    unset($_SESSION);
    $this->view->form = new \Application\Form\LoginForm(); 
    $this->_forward('login');
  }
  
  /**
   * Lister les utilisateurs
   */
  public function listAction()
  {
    $users = $this->_service->getUsers();   
    $this->view->users = $users;
  }
    
  /**
   * Voir un utilisateur
   */
  public function viewAction()
  {
    $id = $this->_request->getParam('id');
		$this->view->user = $this->_service->getUserById($id);
  }
    
  /**
   * Créer une nouvel utilisateur
   */
  public function createAction()
  {
     //$accounts = $mapper->fetchAll();
    $form = new \Application\Form\UserForm();
    $this->view->form = $form;
  }
  
  /**
   * Editer un utilisateur
   */
  public function editAction()
  {
    $id = $this->_request->getParam('id');
    $user = new \Application\Model\User();
    $this->_mapper->find($id, $user);
    $this->view->user = $user;
    $this->view->form = new \Application\Form\UserForm($user);
  }
  
  /**
   * Mettre à jour un utilisateur 
   */
  public function updateAction()
  {
    $id = $this->_request->getParam('id');
    $this->_mapper->save($_POST);
    $this->_forward('view');
  }
  
  /**
   * Suppression d'un utilisateur
   */
  public function deleteAction()
  {
    $id = $this->_request->getParam('id');
    $user = new \Application\Model\User();
    $user = $this->_mapper->find($id, $user);
    $this->_mapper->delete($user);
    $this->_forward('list');
  }
}