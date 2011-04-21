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
 * Classe abstraite de base pour les entités désignant des personnes
 * @AbstractEntity
 */
abstract class AbstractPerson extends AbstractDomainEntity
{
  /**
   * Prénom
   * 
   * @Field [map: 'firstname')
   */  
  protected $_firstname;
  /**
   * Nom
   * 
   * @Validator [lastname: 'required']
   */
  protected $_lastname;
  /**
   * Courriel
   * 
   * @Validator [email: 'email']
   */
  protected $_email;
  /**
   * Téléphone de bureau
   */
  protected $_phoneOffice;
  /**
   * Téléphone mobile
   */
  protected $_phoneMobile;
  /**
   * Téléphone fax
   */
  protected $_phoneFax;
  
  /**
   * Affecter le prénom
   * @param string $firstname
   */
  public function setFirstname($firstname)
  {
    $this->_firstname = (string) $firstname;
    return $this;
  }
	
  /**
   * Obtenir le prénom
   */
  public function getFirstname()
  {
    return $this->_firstname;
  }
  
  /**
   * Affecter le nom
   * @param string $lastname
   */
  public function setLastname($lastname)
  {
    $this->_lastname = (string) $lastname;
    return $this;
  }

  /**
   * Obtenir le nom
   */
  public function getLastname()
  {
    return $this->_lastname;
  }
  
  /**
   * Obtenir le nom complet
   * @param bool $inverse
   */
  public function getFullname($inverse = false)
  {
    if (true === $inverse) {
      return $this->getLastname() . ' ' . $this->getFirstname();
    } else {  
      return $this->getFirstname() . ' ' . $this->getLastname();
    }
  }
  
  /**
   * Affecter le courriel
   * @param string $email
   */
  public function setEmail($email)
  {
    $this->_email = (string) $email;
    return $this;
  }
  
  /**
   * Obtenir le courriel
   */
  public function getEmail()
  {
    return $this->_email;
  }
  
  /**
   * Affecter le téléphone de bureau
   * @param string $phoneOffice
   */
  public function setPhoneOffice($phoneOffice)
  {
    $this->_phoneOffice = (string) $phoneOffice;
    return $this;
  }
  
  /**
   * Obtenir le téléphone de bureau
   */
  public function getPhoneOffice()
  {
    return $this->_phoneOffice;
  }
  
  /**
   * Affecter le téléphone mobile
   * @param string $phoneMobile
   */
  public function setPhoneMobile($phoneMobile)
  {
    $this->_phoneMobile = (string) $phoneMobile;
    return $this;
  }
  
  /**
   * Obtenir le téléphone mobile
   */
  public function getPhoneMobile()
  {
    return $this->_phoneMobile;
  }
  
  /**
   * Affecter le téléphone fax
   * @param string $phoneFax
   */
  public function setPhoneFax($phoneFax)
  {
    $this->_phoneFax = (string) $phoneFax;
    return $this;
  }
  
  /**
   * Obtenir le téléphone fax
   */
  public function getPhoneFax()
  {
    return $this->_phoneFax;
  }
}