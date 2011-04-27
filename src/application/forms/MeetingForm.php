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
 * Formulaire de création de rendez-vous
 */
class MeetingForm extends BaseForm
{
  public function init()
  {
    // Ajoute un champ de type 'text' pour le sujet
    $this->addElement('text', 'title');
    $subjectElement = $this->getElement('title');
    $subjectElement->setLabel('Titre :');
    $subjectElement->setAttrib('required', 'required');
    $subjectElement->setRequired();
    
    // Ajoute un champ de type 'text' pour le lieu
    $this->addElement('text', 'where');
    $whereElement = $this->getElement('where');
    $whereElement->setLabel('Lieu :');
    $whereElement->setAttrib('required', 'required');
    $whereElement->setRequired();
    
    // Ajoute un champ de type 'text' pour la personne invité
    $this->addElement('text', 'who');
    $whoElement = $this->getElement('who');
    $whoElement->setLabel('Qui :');
    $whoElement->setAttrib('required', 'required');
    $whoElement->setRequired();
    
    // Ajoute un champ de type 'date' pour la date de début
    $this->addElement('text', 'beginningDate');
    $beginningDateElement = $this->getElement('beginningDate');
    $beginningDateElement->setLabel('Date de début :');
    $beginningDateElement->setAttrib('data-type', 'date');
    $beginningDateElement->setAttrib('required', 'required');
    $beginningDateElement->setRequired();
    $beginningDateElement->addValidator(new \Zend\Validator\Date());
    
    // Ajoute un champ de type 'time' pour l'heure de début
    $this->addElement('text', 'beginningHour');
    $beginningHour = $this->getElement('beginningHour');
    $beginningHour->setLabel('Heure de début :');
    $beginningHour->setAttrib('data-type', 'time');
    $beginningHour->setAttrib('required', 'required');
    $beginningHour->setRequired();
    
    // Ajoute un champ de type 'date' pour la date de fin
    $this->addElement('text', 'endDate');
    $endDateElement = $this->getElement('endDate');
    $endDateElement->setLabel('Date de fin :');
    $endDateElement->setAttrib('data-type', 'date');
    $endDateElement->setAttrib('required', 'required');
    $endDateElement->setRequired();
    $endDateElement->addValidator(new \Zend\Validator\Date());
    
    // Ajoute un champ de type 'time' pour l'heure de fin
    $this->addElement('text', 'endHour');
    $endHour = $this->getElement('endHour');
    $endHour->setLabel('Heure de fin :');
    $endHour->setAttrib('data-type', 'time');
    $endHour->setAttrib('required', 'required');
    $endHour->setRequired();
    
    // Ajoute un bouton de type 'submit' pour l'envoi du formulaire
    $this->addElement('submit', 'sender');
    $submitElement = $this->getElement('sender');
    $submitElement->setLabel('Inviter');
  }
}
