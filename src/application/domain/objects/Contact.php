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
 * Contact
 * @Entity(collection="contacts")
 */
class Contact extends AbstractPerson
{
	/**
	 * Compte client
	 * 
	 * @var Application\Domain\Object\Account
	 * @ReferenceOne(collection="accounts")
	 * @Validator [account: 'required']
	 */
	protected $_account;
	/**
	 * Fonction dans la société
	 * @var string
	 */
	protected $_jobTitle;
	/**
	 * Département de la société
	 * @var string
	 */
	protected $_department;
	/**
	 * Adresse
	 * @var \Application\Domain\Entity\Address
	 */
	protected $_address;
	
	/**
	 * Affecter le compte client de rattachement
	 * @param \Application\Domain\Entity\Account $account
	 * @throws \Exception
	 */
  public function setAccount($account)
  {
    if (null !== $account && !$account instanceof Account && !is_array($account) && !is_string($account)) {
      throw new \Exception('Invalid account');
    }
      
    if ($account instanceof Account) {  
      $this->_account = $account;
    }
    if (is_array($account)) {
      $this->_account = new Account($account);  
    }
    if (is_string($account)) {
    	$this->_account = (string) $account;
    }
    
    return $this;
  }

  /**
   * Obtenir le compte client de rattachement
   */
  public function getAccount()
  {
    return $this->_account;
  }
	
	/**
	 * Affecter la fonction dans la société
	 * @param string $jobTitle
	 */
	public function setJobTitle($jobTitle)
	{
		$this->_jobTitle = (string) $jobTitle;
		return $this;
	}
	
	/**
	 * Obtenir la fonction dans la société
	 */
	public function getJobTitle()
	{
		return $this->_jobTitle;	
	}
	
	/**
	 * Affecter le département de la société
	 * @param string $department
	 */
	public function setDepartment($department)
	{
		$this->_department = (string) $department;
		return $this;
	}

	/**
	 * Obtenir le département de la société
	 */
	public function getDepartment()
	{
		return $this->_department;
	}
	
	/**
	 * Affecter l'adresse
	 * @param \Application\Domain\Entity\Address $address
	 * @throws \Exception
	 */
	public function setAddress($address)
  {
    if (null !== $address && !$address instanceof Address && !is_array($address)) {
      throw new \Exception('');
    }
    
    if ($address instanceof Address) {
      $this->_address = $address;
    }
    if (is_array($address)) {
      $this->_address = new Address($address);
    }
    
    return $this;
  }
	
  /**
   * Obtenir l'adresse
   */
	public function getAddress()
	{
		return $this->_address;
	}
	
	
  
	/**
	 * Convertir le contact en tableau
	 */
  public function toArray(array $contact)
  {
    $contact = array(
      'id'          => $this->getId(),
      'firstname'   => $this->getFirstname(),
      'lastname'    => $this->getLastname(),
      'email'       => $this->getEmail(),
      'phoneOffice' => $this->getPhoneOffice(),
      'phoneMobile' => $this->getPhoneMobile(),
      'phoneFax'    => $this->getPhoneFax(),
      'society'     => $this->getSociety(),
      'jobTitle'    => $this->getJobTitle(),
      'department'  => $this->getDepartment(),
      'address'     => $this->getAddress() instanceof Address ? $this->getAdresss()->toArray() : null,
      'account'     => $this->getAccount() instanceof Account ? $this->getAccount()->toArray() : null,
      'owner'       => $this->getOwner() instanceof User ? $this->getOwner()->toArray() : null
    );
  }
}