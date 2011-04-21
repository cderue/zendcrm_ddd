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
 * Service d'application pour la gestion des contacts
 */
class ContactApplicationService implements IContactApplicationService
{
	/**
	 * Repository
	 */	
	protected $_repository = null;
	
	/**
	 * Constructeur
	 */
	public function __construct(Repository\IContactRepository $repository)
	{
		$this->_repository = $repository;
	}
	
	public function validateContact(array $postContact)
	{
		
	}
	
	/**
	 * Sélectionner tous les contacts
	 */
	public function getContacts()
	{
		try {
			return $this->_repository->getContacts();
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Sélectionner un contact par son identifiant
	 */
	public function getContactById($id)
	{
		try {
			return $this->_repository->getContactById($id);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Sélectionner un contact par l'identifiant
	 * de son propriétaire
	 */
	public function getContactsByCreatorId($creatorId)
	{
		try {
			return $this->_repository->getContactByCreatorId($creatorId);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Ajouter un contact
	 */
	public function addContact(DomainObject\Contact $contact)
	{
		try {
			$this->_repository->addContact($contact);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Modifier un contact
	 */
	public function modifyContact(DomainObject\Contact $contact)
	{
		try {
			$this->_repository->modifyContact($contact);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Supprimer un contact
	 */
	public function removeContact(DomainObject\Contact $contact)
	{
		try {
			$this->_repository->removeContact($contact);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
}
