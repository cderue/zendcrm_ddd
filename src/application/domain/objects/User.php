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
 * namespace
 */
namespace Application\Domain\Object;

/**
 * Utilisateur
 * @Entity(collection="users")
 */
class User extends AbstractPerson
{
  /** Constantes */
  const STD = 'STD';
  const ADM = 'ADM';

  /**
   * Login
   * @var string
   */ 
  protected $_login;
  /**
   * Mot de passe crypté
   * @var string
   */
  protected $_passwordHash;
  /**
   * Rôle
   * @var string
   */
  protected $_role;
  /**
   * Statut actif ou inactif
   * @var boolean
   */
  protected $_isActive;
  /**
   * Rôle administrateur ou standard
   * @var boolean
   */
  //protected $_isAdmin;

  /**
   * Affecter le login
   * @param string $login
   */
  public function setLogin($login)
  {
    $this->_login = (string) $login;
    return $this;
  }

  /**
   * Obtenir le login
   */
  public function getLogin()
  {
    return $this->_login;
  }

  /**
   * Affecter le mot de passe crypté
   * @param string $passwordHash
   */
  public function setPasswordHash($passwordHash)
  {
    $this->_passwordHash = (string) $passwordHash;
    return $this;
  }

  /**
   * Obtenir le mot de passe crypté
   */
  public function getPasswordHash()
  {
    return $this->_passwordHash;
  }

  /**
   * Affecter le rôle
   * @param string $role
   * @throws \Exception
   */
  public function setRole($role)
  {
    if (self::STD !== $role && self::ADM !== $role) {
      throw new \Exception('Invalid role');
    }

    $this->_role = $role;
    return $this;
  }

  /**
   * Obtenir le rôle
   */
  public function getRole()
  {
    return $this->_role;
  }

  /**
   * Affecter le statut actif ou inactif
   * @param boolean $isActive
   */
  public function setIsActive($isActive)
  {
    $this->_isActive = $isActive;
    return $this;
  }

  /**
    * Obtenir le statut actif ou inactif
    */
  public function getIsActive()
  {
    return $this->_isActive;
  }
  
  /**
   * Vérifier si le login existe déjà
   * @param array $logins
   * @throws \Exception
   */
  public function checkIfLoginExists(array $logins)
  {
  	if (empty($this->_login)) {
  		throw new \Exception('Invalid login');
  	}
  	
  	if (!in_array($this->_login, $logins)) {
  		return true;
  	}
  	
  	return false;
  	
  }
}