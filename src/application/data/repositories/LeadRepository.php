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
namespace Application\Data\Repository;
use \Application\Domain\Object as DomainObject;
use \Application\Domain\Repository as Repository;
use \MongoEntity as Mongo;

/**
 * Repository d'accès aux prospects
 */
class LeadRepository implements Repository\ILeadRepository
{
  /**
	 * Contexte
	 */	
  protected $_context = null;
	
	/**
	 * Constructeur
	 */
	public function __construct(Mongo\IUnitOfWork $unitOfWork)
	{
		//$mongo = \Zend\Registry::get('mongo');
		$this->_context = $unitOfWork;
	}
	
	/**
	 * Sélectionner tous les prospects
	 */
  public function getLeads()
	{
		$query = new Mongo\QueryObject($this->_context);
		
		return $query->select('Application\Domain\Object\Lead');
	}
	
	/**
	 * Sélectionner un prospect par son identifiant
	 */
  public function getLeadById($id)
	{
		$query = new Mongo\QueryObject($this->_context);
		return $query->addCriteria(new Mongo\SimpleCriteria('_id', '==', $id))
								 ->first('Application\Domain\Object\Lead');	
	}
	
	/**
	 * Sélectionne un prospect par l'identifiant
	 * de son créateur
	 */
	public function getLeadsByCreatorId($creatorId)
	{
		$query = new Mongo\QueryObject($this->_context);
	}
	
	/**
	 * Ajouter un prospect
	 */
  public function addLead(DomainObject\Lead $lead)
	{
		$this->_context->addEntity($lead);
	}
	
	/**
	 * Modifier un prospect
	 */	
	public function modifyLead(DomainObject\Lead $lead)
	{
		$this->_context->markAsDirty($lead);
	}
	
	/**
	 * Supprimer un prospect
	 */
  public function removeLead(DomainObject\Lead $lead)
	{
		$this->_context->deleteEntity($lead);
	}
}
