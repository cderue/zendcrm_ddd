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
 * Classe abstraite de base pour toutes les entités du modèle de domaine
 * @Entity
 */
abstract class AbstractDomainEntity implements IValidator
{
	/**
	 * Identifiant unique
	 * 
	 * @Id
	 */
	protected $_id = null;
	/**
	 * Date de création
	 * 
	 * @Field [map: "creation_date"]
	 */
	protected $_creationDate = null;
	/**
	 * Créateur
	 * 
	 * @Field [map: "creator"]
	 * @DBRef 
	 */
	protected $_creator = null;
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
	protected $_messages = array();
	
	/**
	 * Constructeur
	 */
	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
		/*$models = explode('\\', get_class($this));
		$reflexion = new \Zend\Reflection\ReflectionClass(get_class($this));
		$properties = $reflexion->getProperties();
		foreach ($properties as $prop) {
			$doc = $prop->getDocComment();
			$tag = $doc->getTag('Id');
			if ($tag !== false) {
				echo $tag->description;
			}
		}*/
	}
	
	public function __set($name, $value)
  {
  	$method = 'set' . $name;
    if (('mapper' == $name) || !method_exists($this, $method)) {
    	throw new Exception('Invalid guestbook property');
    }
    $this->$method($value);
  }

  public function __get($name)
  {
  	$method = 'get' . $name;
    if (('mapper' == $name) || !method_exists($this, $method)) {
    	throw new Exception('Invalid guestbook property');
    }
    
    return $this->$method();
	}
	
	/**
	 * Initialiser les propriétes de l'objet
	 */
	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}
	
	/**
	 * Affecter la valeur de l'identifiant
	 * @param string $id
	 */
	public function setId($id)
	{
		$this->_id = (string) $id;
		return $this;
	}
	
	/**
	 * Obtenir la valeur de l'identifiant
	 */
	public function getId()
	{
		return $this->_id;
	}
	
	/**
	 * Affecter la date de création
	 * @param string $creationDate
	 */
	public function setCreationDate($creationDate)
	{
		$this->_creationDate = (string) $creationDate;
	}
	
	/**
	 * Obtenir la date de création
	 */
	public function getCreationDate()
	{
		return $this->_creationDate;
	}
	
	/**
	 * Affecter le créateur
	 * @param mixed $creator
	 */
	public function setCreator($creator)
	{	
		/*if (null !== $creator
      && !$creator instanceof User
      && !is_array($creator)) {
      throw new \Exception('Invalid user type');
    }

    if ($creator instanceof User) {  
      $this->_creator = $creator;
    }
    if (is_array($creator)) {
      $this->_creator = new User($creator);
    }*/
		$this->_creator = (string) $creator;
    return $this;
	}
	
	/**
	 * Obtenir le créateur
	 */
	public function getCreator()
	{
		return $this->_creator;
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