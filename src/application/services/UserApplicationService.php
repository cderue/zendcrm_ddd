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
use \Zend\Validator as Validator;
use \Zend\Authentication as Authentication;

/**
 * Service d'application pour la gestion des utilisateurs
 */
class UserApplicationService implements IUserApplicationService
{
	/**
	 * Repository
	 */	
	protected $_repository = null;
	
	/**
	 * Constructeur
	 */
	public function __construct(Repository\IUserRepository $repository)
	{
		$this->_repository = $repository;	
	}
	
	public function validateUser(array $postUser)
	{
		if (!Validator\StaticValidator::execute($postUser['lastname'], 'NotEmpty')) {
			
		}
		if (!Validator\StaticValidator::execute($postUser['email'], 'EmailAddress')) {
			
		}
		if (!Validator\StaticValidator::execute($postUser['login'], 'NotEmpty')) {
			
		}
		if (!Validator\StaticValidator::execute($postUser['role'], 'InArray', array('ADM', 'STD'))) {
			
		}
		if (!Validator\StaticValidator::execute($postUser['is_active'], 'InArray', array(0, 1))) {
			
		}
		
	}
	
	/**
	 * Sélectionner tous les utilisateurs
	 */
	public function getUsers()
	{
		try {	
			return $this->_repository->getUsers();
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Sélectionner un utilisateur par son identifiant
	 */
	public function getUserById($id)
	{
		try {
			return $this->_repository->getUserById($id);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Authentifier un utilisateur
	 */
	public function authenticate($login, $password)
	{
		try {
			$user = $this->_repository->getUserByLoginAndPassword($login, $password);
			if (null !== $user) {
				$storage = new Authentication\Storage\Session();
      	$auth = new Authentication\AuthenticationService($storage); 
      	$result = new Authentication\Result(Authentication\Result::SUCCESS, $user);
      	$auth->getStorage()->write($result->getIdentity());
      } else {
				$result = new Authentication\Result(Authentication\Result::FAILURE, null);
			}
			return $result;
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Ajouter un utilisateur
	 */
	public function addUser(DomainObject\User $user)
	{
		try {	
			$this->_repository->addUser($user);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Modifier un utilisateur
	 */
	public function modifyUser(DomainObject\User $user)
	{
		try {	
			$this->_repository->modifyUser($user);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
	
	/**
	 * Supprimer un utilisateur
	 */
	public function removeUser(DomainObject\User $user)
	{
		try {	
			$this->_repository->removeUser($user);
		} catch (\Exception $ex) {
			// Zend_Log
		}
	}
}
