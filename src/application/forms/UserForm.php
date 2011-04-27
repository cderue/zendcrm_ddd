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
 * Formulaire d'ajout ou d'édition d'un utilisateur
 */
class UserForm extends AbstractPersonForm
{
  /**
   * Constructeur
   */  
  public function __construct(\Application\Model\User $user = null)
  {
    $this->_person = $user;
    // Appelle le constructeur de la classe parente 
    parent::__construct();
  }
  /**
   * Initialise les éléments de formulaire
   */  
  public function init()
  {
    parent::init();
  	
  	// Ajoute un champ de type 'text' pour l'identifiant
  	$this->addElement('text', 'login');
  	$loginElement = $this->getElement('login');
  	$loginElement->setLabel('Identifiant :');
  	
  	// Ajoute ue champ de type 'select' pour le rôle
    $this->addElement('select', 'role');
    $roleElement = $this->getElement('role');
    $roleElement->setLabel('Statut :');
    $roleElement->addMultiOptions(array(
      'admin' => 'Admin',
      'writer' => 'Editeur',
      'reader' => 'Lecteur'
    )); 
  	
  	// Ajoute un champ de type 'checkbox' pour le statut actif ou inactif
  	$this->addElement('select', 'isActive');
  	$isActiveElement = $this->getElement('isActive');
  	$isActiveElement->setLabel('Actif :');
    $isActiveElement->setAttrib('data-role', 'slider');
    $isActiveElement->addMultiOptions(array(
      '1' => 'Oui',
      '0' => 'Non'
    ));
    
    // Ajoute un bouton de type 'submit' pour l'envoi du formulaire
    $this->addElement('submit', 'sender', array('order' => 100));
    $submitElement = $this->getElement('sender');
    $submitElement->setLabel('Enregistrer');
   
    $person = $this->_person;
    if (null !== $this->_person) {
      $loginElement->setValue($person->getLogin());
      $roleElement->setValue($person->getRole());
      $isActiveElement->setValue($person->getIsActive());
    }
  }
}