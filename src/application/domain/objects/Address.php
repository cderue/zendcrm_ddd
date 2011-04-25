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
use Application\Domain\Contract\IValidator;
use \Zend\Validator as Validator;

/**
 * Adresse
 * @EmbeddedEntity
 */
class Address implements IValidator
{
  /**
   * Rue
   * @var string
   */
	protected $_street;
  /**
   * Ville
   * @var string
   */
	protected $_city;
  /**
   * Etat
   * @var string
   */
	protected $_state;
  /**
   * Code postal
   * @var string
   */
	protected $_zipCode;
  /**
   * Pays
   * @var string
   */
	protected $_country;
	/**
	 * Erreurs de validation
	 * @var array
	 */
	protected $_errors = array();
  
	/**
	 * Constructeur
	 * @param string $street
	 * @param string $city
	 * @param string $state
	 * @param string $zipCode
	 * @param string $country
	 */
  public function __construct($street, $city, $state, $zipCode, $country)
  {
    $this->_street = (string) $street;
    $this->_city = (string) $city;
    $this->_state = (string) $state;
    $this->_zipCode = (string) $zipCode;
    $this->_country = (string) $country;
  }
  
  /**
   * Obtenir la rue
   */
  public function getStreet()
  {
  	return $this->_street;
  }
  
  /**
   * Obtenir la ville
   */
	public function getCity()
  {
  	return $this->_city;
  }
  
  /**
   * Obtenir l'état
   */
	public function getState()
  {
  	return $this->_state;
  }
  
  /**
   * Obtenir le code postal
   * 
   * @Validator [zipcode: 'PostCode']
   */
	public function getZipCode()
  {
  	return $this->_zipCode;
  }
  
  /**
   * Obtenir le pays
   */
	public function getCountry()
  {
  	return $this->_country;
  }
  
  /**
   * (non-PHPdoc)
   * @see Application\Domain.IValidator::validate()
   */
  public function validate()
  {
  	$validator = new Validator\StaticValidator();
  	if (!$validator->isValid($this->_zipCode,	'PostCode', array(
      'locale' => 'fr_FR', 
      'format' => '((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}'))) {
  		$this->_errors = $validator->getErrors();
  		return false;
  	}
  	
  	return true;
  }
  
	/**
	 * Valider les données entrantes
	 */
	public function isValid()
	{
	
		
		return true;
	}
	
	public function getErrors()
	{
		return true;
	}
}