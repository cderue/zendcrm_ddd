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
 * Compte client
 * 
 * @Entity [collection: 'accounts']
 */
class Account extends AbstractDomainEntity
{
  /**
   * Nom
   * 
   * @var string
   * @Validator [name: 'required']
   */
	protected $_name;
  /**
   * Téléphone de bureau
   * @var string
   */
	protected $_phoneOffice;
  /**
   * Téléphone fax
   * @var string
   */
	protected $_phoneFax;
	/**
	 * Adresse
	 * @var \Application\Domain\Entity\Address
	 */
	protected $_address;
	
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
	 * Affecter le téléphone fax
	 * @param string $phoneOffice
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
		  $this->_address = new Address(
		  	isset($address['street'])?$address['street']:'',
		  	isset($address['city'])?$address['city']:'',
		  	isset($address['state'])?$address['state']:'',
		  	isset($address['zipCode'])?$address['zipCode']:'',
				isset($address['country'])?$address['country']:''		  	
			);
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
	
	public function __toString()
	{
		return $this->_name;
	}
}

