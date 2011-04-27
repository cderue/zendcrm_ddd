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
namespace MongoEntity;

/**
 * Data Mapper générique
 */
class Persister
{
  /**
   * Adaptateur MongoDB
   */  
  protected $_driver = null;
  
  /**
   * Tableau de mapping entre les entités du modèle 
   * et les collections de la base de données
   */
  protected $_dom = null;
  
  /**
   * Contructeur
   */
  public function __construct($xml, Connection $connection)
  {
    $this->_driver = new Driver($connection);
  	$this->_dom = simplexml_load_file($xml);
  }
  
  /**
   * Obtenir le pilote
   */
  public function getDriver()
  {
  	return $this->_driver;
  }
  
  /**
   * Sélectionner toutes les entités répondant aux critères
   */
  public function findMany($entityClassName, array $criteria)
  {
    $domElement = $this->_dom->xpath("//entity[@name='$entityClassName']/@collection");
    $collection = (string) $domElement[0]->collection; 
    $cursor = $this->_driver->findMany($collection, $criteria);
    $result = iterator_to_array($cursor);
    
    $entities = array();
    foreach ($result as $document) {
      $entity = new $entityClassName();
      $this->_toEntity($document, $entity);
      $entities[] = $entity;
    }
		
    return $entities;
  }
  
  /**
   * Sélectionner la première entité répondant aux critères
   */
  public function findOne($entityClassName , array $criteria)
  {
    /*if (!array_key_exists($entityClassName, $this->_map)) {
      throw new \Exception('Invalid entity class');
    }*/
  	$domElement = $this->_dom->xpath("//entity[@name='$entityClassName']/@collection");
    $collection = (string) $domElement[0]->collection;
    $result = $this->_driver->findOne($collection, $criteria);
    if (0 == count($result)) {
      return false;
    }
   
    return $this->_toEntity($result, new $entityClassName());
  }
  
  /**
   * 
   */
  public function save($entity) 
  {
    $class = get_class($entity);
    if (!array_key_exists($class, $this->_map)) {
      throw new \Exception('Invalid entity class.');
    }
    
    $collection = $this->_map[$class]; 
    $document = array();
    $this->_toEntity($document, $entity);
    if (null === ($id = $entity->getId())) {
      unset($document['id']);
      $this->_driver->insertDocument($collection, $document);
      $entity->setId($document['_id']);
    } else {
      $this->_driver->updateDocument($collection, array('id = ?' => $id), $document);
    }
  }
  
  /**
   * 
   */
  public function delete($id, $entityClassName)
  { 
    $class = get_class($entity);
    if (!array_key_exists($this->_map, $class)) {
      throw new \Exception('Invalid entity class.');
    }
    
    $this->_driver->deleteDocument($collection, array('id = ?' => $id), array());
  }
  
  /**
   * Convertir un document en entité
   * @param array $document
   * @param string $entity
   */
  private function _toEntity(array $document, $entity)
  {
    $reflection = new \ReflectionObject($entity);
    $className = get_class($entity);
    $fields = $this->_dom->xpath("/mapping/entity[@name='$className']/field");
    $references = $this->_dom->xpath("/mapping/entity[@name='$className']/reference");
    $embedded = $this->_dom->xpath("/mapping/entity[@name='$className']/embedded");
    
  	foreach ($fields as $f) {
  		$attr = $f->attributes();
  		$property = (string) $attr['property'];
  		$name = (string) $attr['name'];
  		$prop = $reflection->getProperty($property);
  		if ($prop) {
    		$prop->setAccessible(true);
    		if (isset($document[$name])) {
    			$prop->setValue($entity, $document[$name]);
    		}
  		}	else {
  			throw new \Exception('Invalid property');
  		} 
    }
    
  	foreach ($references as $r) {
  		$attr = $r->attributes();
    	$property = (string) $attr['property'];
  		$name = (string) $attr['name'];
  		$type = (string) $attr['type'];
    	$collection = (string) $attr['collection'];
    
  		$prop = $reflection->getProperty($property);
    	$prop->setAccessible(true);
    	if ($prop && isset($document[$name])) {
    		$field = $this->_driver->getDBRef($collection, $document[$name]);
    		$reference = $this->_toEntity($field, new $type());
    		$prop->setValue($entity, $reference);
    	} else {
    		throw new \Exception('Invalid property');
    	}
    }
    
    foreach ($embedded as $e) {
    	$attr = $e->attributes();
    	$property = (string) $attr['property'];
  		$name = (string) $attr['name'];
  		$type = (string) $attr['type'];
  		
  		$prop = $reflection->getProperty($property);
    	$prop->setAccessible(true);
    	if ($prop && isset($document[$name])) {
    		$prop->setValue($entity, $this->_toEntity($document[$name], new $type()));
    	}
    }
  
    return $entity;
  }
}