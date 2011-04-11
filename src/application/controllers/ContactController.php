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
use Application\Service\IContactApplicationService;
use Application\Form as ApplicationForm;
use Application\Service as ApplicationService; 

/**
 * Contrôleur d'action pour la gestion des contacts
 */
class ContactController extends \Zend\Controller\Action
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
		$this->setApplicationService($this->broker('DiHelper')->direct()->getService('contact_application'));
	}
	
	public function setApplicationService(Service\IContactApplicationService $service)
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
   * Lister les contacts
   */
  public function listAction()
  {
    $contacts = $this->_service->getContacts();   
    $this->view->contacts = $contacts;
  }
    
  /**
   * Voir un contact
   */
  public function viewAction()
  {
    $id = $this->_request->getParam('id');
		$this->view->contact = $this->_service->getContactById($id);
  }
    
  /**
   * Créer un nouveau contact
   */
  public function createAction()
  {
    $accounts = $this->broker('AccountHelper')->direct();
    $this->view->form = new \Application\Form\ContactForm(null, $accounts);
  }
  
  /**
   * Editer un prospect
   */
  public function editAction()
  {
    if ($this->_request->isPost()) {
      $form = new \Application\Form\ContactForm();
      if ($form->isValid($_POST)) {
        // just dump the data for now
        $data = $form->getValues();
        // process the data
        //var_dump($data);
        //exit();
        $this->_forward('list');
      } else {
        //var_dump($form->getErrors());
      }
    } else { 
      $id = $this->_request->getParam('id');
      $contact = new \Application\Model\Contact();
      $this->_mapper->find($id, $contact);
      //$this->view->contact = $contact;
      $accounts = $this->broker('AccountHelper')->direct();    
      $this->view->form = new \Application\Form\ContactForm($contact, $accounts);
    }
  }
  
  /**
   * Mettre à jour un prospect 
   */
   /*
  public function updateAction()
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
    $contact = new \Application\Model\Contact();
    $contact = $this->_mapper->find($id, $contact);
    $mapper->delete($contact);
    $this->_forward('list');
  }
}