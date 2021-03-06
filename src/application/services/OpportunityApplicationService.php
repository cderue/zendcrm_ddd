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
use Application\Domain\Object as DomainObject;
use Application\Domain\Contract as Repository;

/**
 * Service d'application pour la gestion des opportunités
 */
class OpportunityApplicationService implements IOpportunityApplicationService
{
	/**
	 * Repository
	 */	
	protected $_repository = null;
	
	/**
	 * Constructeur
	 */
	public function __construct(Repository\IOpportunityRepository $repository)
	{
		$this->_repository = $repository;
	}
	
	public function validateAOpportunity(array $postOpportunity)
	{
		if (!Validator\StaticValidator::execute($postUser['name'], 'NotEmpty')) {
			
		}
		if (!Validator\StaticValidator::execute($postUser['account'], 'Alnum')) {
			
		}
		if (!Validator\StaticValidator::execute($postUser['date_closed'], 'Date')) {
			
		}
		if (!Validator\StaticValidator::execute($postUser['status'], 'InArray', array())) {
			
		}
	}
	
	/**
	 * Sélectionner toutes les opportunités
	 */
	/*public function getOpportunities()
	{
		try {
			return $this->_repository->getOpportunities();
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}*/
	
	/**
	 * Sélectionner une opportunité par son identifiant
	 */
	public function getOpportunityById($id)
	{
		try {	
			return $this->_repository->getOpportunityById($id);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Sélectionner une opportunité par l'identifiant
	 * de son propriétaire
	 */
	public function getOpportunitiesByCreatorId($creatorId)
	{
		try {	
			return $this->_repository->getOpportunitiesByCreatorId($creatorId);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Ajouter une opportunité
	 */
	public function addOpportunity(DomainObject\Opportunity $opportunity)
	{
		try {
			$this->_repository->addOpportunity($opportunity);	
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Modifier une opportunité
	 */
	public function modifyOpportunity(DomainObject\Opportunity $opportunity)
	{
		try {
			$this->_repository->modifyOpportunity($opportunity);	
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * 
	 */
	public function removeOpportunity(DomainObject\Opportunity $opportunity)
	{
		try {
			$this->_repository->removeOpportunity($opportunity);	
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
}
