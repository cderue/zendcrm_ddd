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
namespace Application\Domain\Object;

/**
 * Opportunité
 * @Entity(collection="opportunities")
 */
class Opportunity extends AbstractDomainEntity
{
  /**
   * Nom
   * @var string
   */
  protected $_name;
  /**
   * Compte client
   * 
   * @var mixed (\Application\Domain\Object\Acccout | array)
   * @ReferenceOne(collection="accounts")
   * @Validator [account: 'required']
   */
  protected $_account;
  /**
   * Montant
   * 
   * @var float
   * @Validator [amount: 'required']
   */
  protected $_amount;
  /**
   * Date de clôture
   * 
   * @var string
   * @Validator [date_closed: 'required']
   */
  protected $_dateClosed;
  /**
   * Probabilité de gain
   * @var string
   */
  protected $_probability;
  /**
   * Statut (en attente, gagnée ou perdue)
   * @var string
   */
  protected $_status;
  /**
   * Contact
   * @var mixed
   * @ReferenceOne(collection="contacts")
   */
  protected $_contact;
  /**
   * Affecter le nom
   * @param string $name
   */
  public function setName($name)
  {
    $this->_name = (string) $name;
    return $this;
  }

  /**
   * Obtenir le nom
   */
  public function getName()
  {
    return $this->_name;
  }

  /**
   * Affecter le compte client
   * @param mixed $account
   * @throws \Exception
   */
  public function setAccount($account)
  {
    if (null !== $account
      && !$account instanceof Account
      && !is_array($account)) {
      throw new \Exception('Invalid account type');
    }

    if ($account instanceof Account) {  
      $this->_account = $account;
    }
    if (is_array($account)) {
      $this->_account = new Account($account);
    }
    return $this;
  }

  /**
   * Obtenir le compte client
   */
  public function getAccount()
  {
    return $this->_account;
  }

  /**
   * Affecter le montant
   * @param float $amount
   */
  public function setAmount($amount)
  {
    $this->_amount = (float) $amount;
    return $this;
  }

  /**
   * Obtenir le montant
   */
  public function getAmount()
  {
    return $this->_amount;
  }

  /**
   * Affecter la date de clôture
   * @param string $dateClosed
   */
  public function setDateClosed($dateClosed)
  {
    $this->_dateClosed = $dateClosed;
    return $this;
  }

  /**
   * Obtenir la date de clôture
   */
  public function getDateClosed()
  {
    return $this->_dateClosed;
  }

  /**
   * Affecter la probabilité de gain
   * @param int $probability
   */
  public function setProbability($probability)
  {
    $this->_probability = (int) $probability;
    return $this;
  }

  /**
   * Obtenir la probabilité de gain
   */
  public function getProbability()
  {
    return $this->_probability;
  }

  /**
   * Affecter le statut
   * @param string $status
   */
  public function setStatus($status)
  {
    $this->_status = (string) $status;
    return $this;
  }

  /**
   * Obtenir le statut
   */
  public function getStatus()
  {
    return $this->_status;  
  }

  /**
   * Affecter le contact
   * @param mixed $contact
   * @throws \Exception
   */
  public function setContact($contact)
  {
    if (null !== $contact && !$contact instanceof Contact && !is_array($contact)) {
      throw new \Exception('');
    }

    if ($contact instanceof Contact) {  
      $this->_contact = $contact;
    }
    if (is_array($contact)) {
      $this->_contact = new Contact($contact);  
    }
    
    return $this;
  }

  /**
   * Obtenir le contact
   */
  public function getContact()
  {
    return $this->_contact;
  }
}
