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
namespace Application\Form;

/**
 * Formulaire de création ou d'édition d'un compte client
 */
class AccountForm extends BaseForm
{
  /**
   * Variable de type 'Application\Model\Account'
   */  
  protected $_account = null;
  
  /**
   * Constructeur
   */
  public function __construct(\Application\Model\Account $account = null)
  {
    $this->_account = $account;
    parent::__construct();
  }
  
  /**
   * Initialise les éléments de formulaire
   */
  public function init()
  {	
    // Ajoute un champ de type 'text' pour le nom
  	$this->addElement('text', 'name');
  	$nameElement = $this->getElement('name');
  	$nameElement->setLabel('Nom :');
  	$nameElement->setRequired();
       
  	// Ajoute un champ de type 'tel' pour le téléphone de bureau
  	$this->addElement('text', 'phoneOffice');
  	$phoneOfficeElement = $this->getElement('phoneOffice');
  	$phoneOfficeElement->setLabel('Tél. bureau :');
  	
  	// Ajoute un champ de type 'tel' pour le téléphone mobile
  	//$this->addElement('text', 'phoneMobile');
  	//$phoneMobileElement = $this->getElement('phoneMobile');
  	//$phoneMobileElement->setLabel('Tél mobile :');
  	
  	// Ajoute un champ de type 'tel' pour le téléphone fax
  	$this->addElement('text', 'phoneFax');
  	$phoneFaxElement = $this->getElement('phoneFax');
  	$phoneFaxElement->setLabel('Tél fax :');
  	
  	// Ajoute un champ de type 'text' pour la rue
    $this->addElement('text', 'addressStreet');
    $addressStreetElement = $this->getElement('addressStreet');
    $addressStreetElement->setLabel('Rue :');
      
    // Ajoute un champ de type 'text' pour la ville
    $this->addElement('text', 'addressCity');
    $addressCityElement = $this->getElement('addressCity');
    $addressCityElement->setLabel('Ville :');
      
    // Ajoute un champ de type 'text' pour l'état ou la région
    $this->addElement('text', 'addressState');
    $addressStateElement = $this->getElement('addressState');
    $addressStateElement->setLabel('Etat :');
    
    // Ajoute un champ de type 'text' pour le code postal
    $this->addElement('text', 'addressZipCode');
    $addressZipCodeElement = $this->getElement('addressZipCode');
    $addressZipCodeElement->setLabel('Code postal :');
    $addressZipCodeElement->addValidator('PostCode', array(
      'locale' => 'fr_FR', 
      'format' => '((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}'));
    
    // Ajoute un champ de type 'select' pour le pays
    $this->addElement('select', 'addressCountry');
    $addressCountryElement = $this->getElement('addressCountry');
    $addressCountryElement->setLabel('Pays :');
    
    // Ajoute un bouton de type 'submit' pour l'envoi du formulaire
    $this->addElement('submit', 'sender');
    $submitElement = $this->getElement('sender');
    $submitElement->setLabel('Enregistrer');
    
    $account = $this->_account;
    if (null !== $account) {
      $nameElement->setValue($account->getName());
      $phoneOfficeElement->setValue($account->getPhoneOffice());
      //$phoneMobileElement->setValue($account->getPhoneMobile());
      $phoneFaxElement->setValue($account->getPhoneFax());
      // Recupère l'adresse
      $address = $account->getAddress();
      if (null !== $address) {
        $addressStreetElement->setValue($address->getStreet());
        $addressCityElement->setValue($address->getCity());
        $addressStateElement->setValue($address->getState());
        $addressZipCodeElement->setValue($address->getZipCode());
        $addressCountryElement->setValue($address->getCountry());
      }
    }
	}
}
