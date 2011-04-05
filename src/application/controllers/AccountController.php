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
use Application\Form as Form;
use Application\Service as Service;
use Application\Domain\Object as DomainObject;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               

/**
 * Contrôleur d'action pour la gestion des comptes clients
 */
class AccountController extends \Zend\Controller\Action
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
  	$this->_service = $this->broker('DiHelper')->direct();
  }
	
  /**
   * Action par défaut
   */
  public function indexAction()
  {
      return $this->_forward('list');
  }
  
  /**
   * Lister les comptes clients
   */
  public function listAction()
  {
    $accounts = $this->_service->getAccounts();   
    $this->view->accounts = $accounts;
  }
    
  /**
   * Voir un compte client
   */
  public function viewAction()
  {
    $id = $this->_request->getParam('id');
    $account = new \Application\Model\Account();
    $this->_service->getAccount($id, $account);
    $this->view->account = $account;
  }
    
  /**
   * Créer un nouveau compte client
   */
  public function createAction()
  {
    if ($this->_request->isPost()) {
    	
		} else {	
    	$form = new \Application\Form\AccountForm();
    	$this->view->form = $form;
		}
  }
  
  /**
   * Editer un compte client
   */
  public function editAction()
  {
    if ($this->_request->isPost()) {
      $form = new \Application\Form\AccountForm();
      if ($form->isValid($_POST)) {
        $data = $form->getValues();
      }
    } else {
      $id = $this->_request->getParam('id');
      $account = new \Application\Model\Account();
      $this->_mapper->find($id, $account);
      //$this->view->account = $account;
      $this->view->form = new \Application\Form\AccountForm($account);  
    } 
  }
  
  /**
   * Supprimer un compte client
   */
  public function deleteAction()
  {
    $id = $this->_request->getParam('id');
    $this->_mapper->delete($id, 'Application\Model\Account');
    $this->_forward('list');
  }
}