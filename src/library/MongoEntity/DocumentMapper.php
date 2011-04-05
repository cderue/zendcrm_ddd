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
class DocumentMapper
{
  /**
   * Adaptateur MongoDB
   */  
  protected $_driver = null;
  
  /**
   * Tableau de mapping entre les entités du modèle 
   * et les collections de la base de données
   */
  protected $_map = null;
  
  /**
   * Contructeur
   */
  public function __construct($config)
  {
    $this->_driver = new Driver($config);
  	$this->_map = array(
      'Application\Domain\Object\User'        => 'users',
      'Application\Domain\Object\Lead'        => 'leads',
      'Application\Domain\Object\Contact'     => 'contacts',
      'Application\Domain\Object\Account'     => 'accounts',
      'Application\Domain\Object\Opportunity' => 'opportunities'
    );
  }
  
  public function getDriver()
  {
  	return $this->_driver;
  }
  
  /**
   * 
   */
  public function findMany($entityClassName, array $criteria)
  {
    //
    $collection = $this->_map[$entityClassName];  
    
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
   * 
   */
  public function findOne(array $criteria, $entity)
  {
    if (!ctype_alnum($id)) {
      throw new \Exception('Invalid argument. $id must be alphanumeric.');  
    }

    $class = get_class($entity);
    if (!array_key_exists($class, $this->_map)) {
      throw new \Exception('Invalid entity class.');
    }
    
    $collection = $this->_map[$class];
    $criteria = array('_id' => new \MongoId($id));
    $result = $this->_driver->findOne($collection, $criteria);
    if (0 == count($result)) {
      return false;
    }
   
    $this->_toEntity($result, $entity);
    
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
   * 
   * Enter description here ...
   */
  private function _toArray()
  {
  	
  }
  
  /**
   * 
   */
  private function _toEntity(array $document, $entity)
  {
  
    $document['id'] = $document['_id']->__toString();
    $entity->setOptions($document);

    return $entity;
  }
}