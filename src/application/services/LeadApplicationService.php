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
namespace Application\Service;
use Application\Domain;
use Application\Domain\Object as DomainObject;
use Application\Domain\Service as DomainService;
use Application\Domain\Repository as Repository;

/**
 * Service du domaine pour la gestion des prospects
 */
class LeadApplicationService implements ILeadApplicationService
{
  /**
   *
   * @var unknown_type
   */
  private $_leadDomainService = null;
  /**
   * Object Document Mapper générique
   */  
  private $_repository = null;
  
  /**
   * Constructeur
   */
  public function __construct(DomainService\ILeadConverterDomainService $leadDomainService, Repository\ILeadRepository $repository)
  {
    $this->_leadDomainService = $leadDomainService;
  	$this->_repository = $repository;
  }
  
	/**
	 * Sélectionner tous les prospects
	 */
  public function getLeads()
	{
		try {	
			return $this->_repository->getLeads();
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Sélectionner un prospect par son identifiant
	 */
	public function getLeadById($id)
	{
		try {	
			return $this->_repository->getLeadById($id);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Sélectionner un prospect par l'identifiant
	 * de son propriétaire
	 */
	public function getLeadsByCreatorId($creatorId)
	{
		try {	
			return $this->_repository->getLeadByOwnerId($ownerId);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Ajouter un prospect
	 */
	public function addLead(DomainObject\Lead $lead)
	{
		try {	
			$this->_repository->addLead($lead);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Modifier un prospect
	 */
	public function modifyLead(DomainObject\Lead $lead)
	{
		try {	
			$this->_repository->modifyLead($lead);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Supprimer un prospect
	 */
	public function removeLead(DomainObject\Lead $lead)
	{
		try {	
			$this->_repository->removeLead($lead);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
  
  /**
   * Convertir un prospect en contact
   */
  /*public function convertLeadToContact(ApplicationModel\Lead $lead, ApplicationModel\Contact $contact)
  {
    try {	
    	$options = $lead->toArray();
    	unset($options['status']);  
    	$contact->setOptions($options);
		} catch (\Exception $ex) {
			// Zend_Log
		}
  }*/
}
