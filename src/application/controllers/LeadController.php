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
use Application\Repository as Repository;

/**
 * Contrôleur d'action pour la gestion des prospects
 */
class LeadController extends \Zend\Controller\Action
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
  	$this->setApplicationService($this->broker('DiHelper')->direct()->getService('lead.application'));
  }
  
	public function setApplicationService(Service\ILeadApplicationService $service)
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
   * Lister les prospects
   */
  public function listAction()
  {
		$auth = new \Zend\Authentication\AuthenticationService();
		$identity = $auth->getIdentity();
  	$leads = $this->_service->getLeadsByCreatorId($identity->getId());   
    $this->view->leads = $leads;
  }
    
  /**
   * Voir un prospect
   */
  public function viewAction()
  {
		$id = $this->_request->getParam('id');
		$this->view->lead = $this->_service->getLeadById($id);
  }
    
  /**
   * Créer un nouveau prospect
   */
  public function createAction()
  {
    //$accounts = $mapper->fetchAll();
  	$form = new \Application\Form\LeadForm();
    $this->view->form = $form;
  }
  
  /**
   * Editer un prospect
   */
  public function editAction()
  {
    $id = $this->_request->getParam('id');
    $lead = new \Application\Model\Lead();
    $this->_mapper->find($id, $lead);
    $this->view->lead = $lead;
    $this->view->form = new \Application\Form\LeadForm($lead);
  }
  
/*  public function updateAction()
  {
    $id = $this->_request->getParam('id');
    $this->_mapper->save($_POST);
    $this->_forward('view');
  }*/
  
  /**
   * Supprimer un prospect
   */
  public function deleteAction()
  {
		$id = $this->_request->getParam('id');
    $lead = new \Application\Model\Lead();
    $lead = $this->_mapper->find($id, $lead);
		$this->_mapper->delete($lead);
		$this->_forward('list');
  }
}