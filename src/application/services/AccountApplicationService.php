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
use Application\Domain\Repository as Repository;

/**
 * Service du domaine pour la gestion des comptes clients
 */
class AccountApplicationService implements IAccountApplicationService
{
	/**
	 * Repository
	 */	
	protected $_repository = null;	
	
	/**
	 * Constructeur
	 */
	public function __construct(Repository\IAccountRepository $repository)
	{
		$this->_repository = $repository;
	}
	
	/**
	 * Sélectionner tous les comptes clients 
	 */
	public function getAccounts()
	{
		try {	
			return $this->_repository->getAccounts();
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Sélectionner un compte client par son identifiant
	 */
	public function getAccountById($id, ApplicationModel $account)
	{
		try {	
			return $this->_repository->getAccountById($id, $account);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Sélectionner un compte client par l'identifiant
	 * des on propriétaire 
	 */
	public function getAccountByOwnerId($ownerId)
	{
		try {	
			return $this->_repository->getAccountByOwnerId($ownerId);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Ajouter un compte client
	 */
	public function addAccount(ApplicationModel\Account $account)
	{
		try {	
			$this->_repository->addAccount($account);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Modifier un compte client
	 */
	public function modifyAccount(ApplicationModel\Account $account)
	{
		try {	
			$this->_repository->modifyAccount($account);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Supprimer un compte client
	 */
	public function removeAccount(ApplicationModel\Account $account)
	{
		try {	
			$this->_repository->removeAccount($account);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
}