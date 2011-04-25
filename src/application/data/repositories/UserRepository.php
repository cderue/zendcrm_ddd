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
use \Application\Domain\Contract as Repository;
use \MongoEntity as Mongo;

/**
 * Repository d'accès aux utilisateurs
 */
class UserRepository implements Repository\IUserRepository
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
	 * Sélectionner tous les utilisateurs
	 */
  public function getUsers()
	{
		$query = new Mongo\QueryObject($this->_context);
		return $query->select('Application\Domain\Object\User');
	}
	
	/**
	 * Sélectionner un utilisateur par son identifiant
	 */
  public function getUserById($id)
	{
		$query = new Mongo\QueryObject($this->_context);
		return $query->addCriteria(new Mongo\SimpleCriteria('_id', '==', $id))
								 ->first('Application\Domain\Object\User');
	}
	
	/**
	 * Sélectionne un utilisateur par son identifiant de connexion
	 * et son mot de passe
	 */
	public function getUserByLoginAndPassword($login, $password)
	{
		$query = new Mongo\QueryObject($this->_context);
		return $query->addCriteria(new Mongo\SimpleCriteria('_login', '==', $login))
								 ->addCriteria(new Mongo\SimpleCriteria('_password_hash', '==', $password))
								 ->first('Application\Domain\Object\User');
	}
	
	/**
	 * Ajouter un utilisateur
	 */
  public function addUser(DomainObject\User $user)
	{
		$this->_context->addEntity($user);
	}
	
	/**
	 * Modifier un utilisateur
	 */	
	public function modifyUser(DomainObject\User $user)
	{
		$this->_context->markAsDirty($user);
	}
	
	/**
	 * Supprimer un utilisateur
	 */
  public function removeUser(DomainObject\User $user)
	{
		$this->_context->deleteEntity($user);
	}
}
