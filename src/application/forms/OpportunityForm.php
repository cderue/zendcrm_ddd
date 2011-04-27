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
 * Formulaire de création ou d'édition d'une opportunité
 */
class OpportunityForm extends BaseForm
{
  protected $_opportunity = null;
  
  protected $_accounts = null;
  
  public function __construct(\Application\Model\Opportunity $opportunity = null, $accounts = array())
  {
    $this->_opportunity = $opportunity;
    $this->_accounts = $accounts;
    // Appelle le constructeur de la classe parente  
    parent::__construct();
  }
  
  /**
   * Initialise les éléments de formulaire
   */  
  public function init()
  {
  	// Appelle le constructeur de la classe parente    
  	parent::init();
    
  	// Ajoute un champ de type 'text' pour le nom
  	$this->addElement('text', 'name');
  	$nameElement = $this->getElement('name');
  	$nameElement->setLabel('Nom :');
  	$nameElement->setRequired();
    
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
  	
  	// Ajoute un champ de type 'number' pour le montant
  	$this->addElement('text', 'amount');
  	$amountElement = $this->getElement('amount');
  	$amountElement->setLabel('Montant :');
    $amountElement->setAttrib('data-type', 'number');
    $amountElement->addValidator(new \Zend\Validator\Digits());
  	
  	// Ajoute un champ de type 'number' pour la probabilité
  	$this->addElement('text', 'probability');
  	$probabilityElement = $this->getElement('probability');
    $probabilityElement->setLabel('Probabilité :');
    $probabilityElement->setAttrib('data-type', 'number');
    $probabilityElement->addValidator(new \Zend\Validator\Digits());
  	
  	// Ajoute un champ de type 'date' pour la date de clôture
  	$this->addElement('text', 'dateClosed');
  	$dateClosedElement = $this->getElement('dateClosed');
  	$dateClosedElement->setLabel('Date de clôture :');
    $dateClosedElement->setAttrib('data-type', 'date');
  	$dateClosedElement->setRequired();
    $dateClosedElement->addValidator(new \Zend\Validator\Date());
    
    // Ajoute un bouton de type 'submit' pour l'envoi du formulaire
    $this->addElement('submit', 'sender', array('order' => 100));
    $submitElement = $this->getElement('sender');
    $submitElement->setLabel('Enregistrer');
    
    $opportunity = $this->_opportunity;
    if (null !== $opportunity) {
      $nameElement->setValue($opportunity->getName());
      $amountElement->setValue($opportunity->getAmount());
      $probabilityElement->setValue($opportunity->getProbability());
      $dateClosedElement->setValue($opportunity->getDateClosed());
    }
  }
}