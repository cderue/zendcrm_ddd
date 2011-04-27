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
 * Formulaire de création ou d'édition d'un prospect
 */
class ContactForm extends AbstractPersonForm
{
  protected $_accounts = null;  
    
  public function __construct(\Application\Model\Contact $contact = null, array $accounts = array())
  {
    $this->_person = $contact;
    $this->_accounts = $accounts;
    parent::__construct();
  }
  
  /**
   * Initialise les éléments de formulaire
   */  
  public function init()
  {
    // Appelle le constructeur de la classe parente  
    parent::init();
    
    // Ajoute le champ de type 'text pour la société
    $this->addElement('text', 'society');
    $societyElement = $this->getElement('society');
    $societyElement->setLabel('Société:');
    $societyElement->setAttrib('pattern', '');
  
    // Ajoute le champ de type 'text' pour la fonction
    $this->addElement('text', 'jobTitle');
    $jobTitleElement = $this->getElement('jobTitle');
    $jobTitleElement->setLabel('Fonction:');
    $jobTitleElement->setAttrib('placeholder', 'ex : Directeur');
    $jobTitleElement->setAttrib('pattern', '');
      
    // Ajoute le champ de type 'text' pour le département de la société
    $this->addElement('text', 'department');
    $departmentElement = $this->getElement('department');
    $departmentElement->setLabel('Departement:');
    $departmentElement->setAttrib('placeholder', 'ex : Département des achats');
    $departmentElement->setAttrib('pattern', '');
    
    // Ajoute un champ de type 'text' pour la rue
    $this->addElement('text', 'addressStreet');
    $addressStreetElement = $this->getElement('addressStreet');
    $addressStreetElement->setLabel('Rue :');
      
    // Ajoute un champ de type 'text' pour la ville
    $this->addElement('text', 'addressCity');
    $addressCityElement = $this->getElement('addressCity');
    $addressCityElement->setLabel('Ville :');
      
    // Ajoute un champ de type 'text pour l'état ou la région.
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
    $this->addElement('text', 'addressCountry');
    $addressCountryElement = $this->getElement('addressCountry');
    $addressCountryElement->setLabel('Pays :');
      
    // Ajoute un champ de type 'select' pour le choix du compte client
    $this->addElement('select', 'account');
    $accountElement = $this->getElement('account');
    $accountElement->setLabel('Compte client :');
    $accountOptions = array();
    // Initialise la liste avec les données de comptes client
    foreach ($this->_accounts as $account) {
      if (!$account instanceof \Application\Model\Account) {
        throw new \Exception('Account must be an instance of \Application\Model\Account.');
      }
      $accountOptions[$account->getId()] = $account->getName();
    }
    $accountElement->addMultiOptions($accountOptions);
    
    // Ajoute un bouton de type 'submit' pour l'envoi du formulaire
    $this->addElement('submit', 'sender', array('order' => 100));
    $submitElement = $this->getElement('sender');
    $submitElement->setLabel('Enregistrer');
    
    $contact = $this->_person;
    if (null !== $contact) {
      $societyElement->setValue($contact->getSociety());
      $jobTitleElement->setValue($contact->getJobTitle());
      $departmentElement->setValue($contact->getDepartment());
      // Récupère l'adresse
      $address = $contact->getAddress();
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