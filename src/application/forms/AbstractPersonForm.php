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
 * Formulaire abstrait de création ou d'édition d'une personne
 */
abstract class AbstractPersonForm extends BaseForm
{
  /**
   * Variable de type 'Application\Model\AbstractPerson'
   */  
  protected $_person = null;  
  
  /**
   * Initialise les éléments du formulaire
   */  
  public function init()
  {
    // Ajoute un champ de type 'text' pour le prénom 
    $this->addElement('text', 'firstname');
    $firstnameElement = $this->getElement('firstname');
    $firstnameElement->setLabel('Prénom :');
    
    // Ajoute un champ de type 'text' pour le nom
    $this->addElement('text', 'lastname');
    $lastnameElement = $this->getElement('lastname');
    $lastnameElement->setLabel('Nom :');
    $lastnameElement->setRequired();
      
    // Ajoute le champ de type 'email' pour le courriel (HTML5)
    $this->addElement('text', 'email');
    $emailElement = $this->getElement('email');
    $emailElement->setLabel('Courriel :');
    $emailElement->setAttrib('data-type', 'email');
    $emailElement->addValidator(new \Zend\Validator\EmailAddress());
    
    // Ajoute un champ de type 'text' pour le téléphone de bureau
    $this->addElement('text', 'phoneOffice');
    $phoneOfficeElement = $this->getElement('phoneOffice');
    $phoneOfficeElement->setLabel('Tél. bureau :');
    $phoneOfficeElement->setAttrib('data-type', 'tel');
    
    // Ajoute un champ de type 'text' pour le téléphone mobile
    $this->addElement('text', 'phoneMobile');
    $phoneMobileElement = $this->getElement('phoneMobile');
    $phoneMobileElement->setLabel('Tél. mobile :');
    $phoneMobileElement->setAttrib('data-type', 'tel');
    
    // Ajoute un champ de type 'text' pour la téléphone fax
    $this->addElement('text', 'phoneFax');
    $phoneFaxElement = $this->getElement('phoneFax');
    $phoneFaxElement->setLabel('Tél. fax :');
    $phoneFaxElement->setAttrib('data-type', 'tel');
    
    $person = $this->_person;
    if (null !== $person) {
      $firstnameElement->setValue($person->getFirstname());
      $lastnameElement->setValue($person->getLastname());
      $emailElement->setValue($person->getEmail());
      $phoneOfficeElement->setValue($person->getPhoneOffice());
      $phoneMobileElement->setValue($person->getPhoneMobile());
      $phoneFaxElement->setValue($person->getPhoneFax());
    }
  }
}