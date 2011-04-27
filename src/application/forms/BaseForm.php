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
 * Formulaire de base pour tous les formulaires de ZendCRM
 */
class BaseForm extends \Zend\Form\Form
{
  /**
   * Message d'erreur
   */  
  protected $_error;
  /**
   * Contructeur
   */  
  public function __construct()
  {
    parent::__construct();
    // Surcharge les décorateurs de formulaire par défaut
    foreach ($this->_elements as $element) {
      if ($element->getType() !== 'Zend\Form\Element\Submit') {
        $element->setDecorators(array(
          'ViewHelper',
          'Label',
          'Errors',
          array(array('data' => 'HtmlTag'), array('tag' => 'div', 'data-role' => 'fieldcontain'))
        ));
      } else {
        $element->setDecorators(array(
          'ViewHelper',
          'Errors',
          array(array('data' => 'HtmlTag'), array('tag' => 'div', 'data-role' => 'fieldcontain'))
        ));
      }  
      
      // Ajoute des filtres par défaut pour nettoyer les données
      //$element->addFilter(new \Zend\Filter\StripTags());
      //$element->addFilter(new \Zend\Filter\HtmlEntities());
      //$element->addFilter(new \Zend\Filter\StringTrim());
    }
    
    // Ajoute un token de formulaire pour prévenir les attaques CSRF 
    $this->addElement('hash', 'anti_csrf_token', array('salt' => 'unique'));
    $tokenElement = $this->getElement('anti_csrf_token');
    $tokenElement->clearDecorators();
    $tokenElement->setDecorators(array('ViewHelper'));
  }
}