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
 * Repository d'accès aux comptes clients
 */
class AccountRepository implements IAccountRepository
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
		$this->_context = $unitOfWork;
	}
	
	/**
	 * Sélectionner tous les comptes clients
	 */
  public function getAccounts()
	{	
		$query = new \Mongo\QueryObject('Account');
		return $query->select();
	}
	
	/**
	 * Sélectionner un compte client par son identifiant
	 */
  public function getAccountById($id, DomainObject\Account $account)
	{
		$query = new \Mongo\QueryObject('Account');
		$query->addCriteria(new SimpleCriteria('_id', '==', $id));
		$account = $query->select();
	}
	
	/**
	 * Sélectionne un compte client par l'identifiant
	 * de son propriétaire
	 */
	public function getAccountsByOwnerId($ownerId)
	{
		$query = new \Mongo\QueryObject('Account');
		$query->addCriteria(new SimpleCriteria(array('_owner' => '_id'), '==', $ownerId));
		$account = $query->select();
	}
	
	/**
	 * Ajouter un compte client
	 */
  public function addAccount(DomainObject\Account $account)
	{
		$this->_context->addEntity($account);
	}
	
	/**
	 * Modifier un compte client
	 */	
	public function modifyAccount(DomainObject\Account $account)
	{
		$this->_context->markAsDirty($account);
	}
	
	/**
	 * Supprimer un compte client
	 */
  public function removeAccount(DomainObject\Account $account)
	{
		$this->_context->deleteEntity($account);
	} 
}