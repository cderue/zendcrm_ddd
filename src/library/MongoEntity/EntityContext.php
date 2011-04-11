<?php
/**
 * @namespace
 */
namespace MongoEntity;

/**
 * Entity Context
 */
class EntityContext implements IUnitOfWork
{
  /*const ADDED    = 1;
	const DIRTY  	 = 2;
	const DELETED  = 3;
	const ATTACHED = 4;
	const DETACHED = 5;
  */
  /**
	 * Document Mapper
	 */	
  private $_mapper = null;
  /**
   * Etats des entités du contexte
   * (ADDED, DIRTY, DELETED, ATTACHED ou DETACHED)
   */
  //private $_states = array();
	/**
	 * Entités ajoutées au contexte
	 */
  //private $_added = array();  
  /**
	 * Entités modifiées dans le contexte
	 */
  //private $_updated = array();
  /**
	 * Entités supprimées du contexte
	 */
  private $_delete = array();
  /**
   * Entités attachées au contexte
   */
  private $_persist = array();
  /**
   * Configuration de la connexion
   */
  //private $_config = null;
  
	/**
	 * Constructeur
	 */
  public function __construct(Connection $connection)
  {
    //$this->_config = $config;
    $this->_mapper = new Persister($connection);
  }
  
  public function getMapper()
  {
  	return $this->_mapper;
  }
  
	/**
	 * Ajouter une entité
	 */
	public function persistEntity($entity) {
		$class = get_class($entity);
		$uid = spl_object_hash($entity);
		$this->_persist[$class][$uid] = $entity; 
		//$this->_states[$uid] = self::ADDED;
  }
	
	/**
	 * Mettre à jour une entité
	 */  
  /*
  public function updateEntity($entity) {
    $uid = spl_object_hash($entity);
    if (!array_key_exists($uid, $this->_dirty)) {
    	$this->_dirty[$uid] = $entity; 
    }
    $this->_states[$uid] = self::DIRTY;
  }*/
	
	/**
	 * Supprimer une entité
	 */
  public function deleteEntity($entity) {
  	$class = get_class($entity);
		$uid = spl_object_hash($entity);
		$this->_delete[$class][$uid] = $entity; 
    
 	}
 	
 	/**
 	 * 
 	 * Enter description here ...
 	 * @param unknown_type $entity
 	 */
 	/*public function attachEntity($entity)
 	{
 		$id = $this->_getIdentifierValue($entity);
 	}*/
 	
 	/**
 	 * Détacher une entité du contexte
 	 * @param object $entity
 	 */
 	/*public function detachEntity($entity)
 	{
 		$uid = spl_object_hash($entity);
    if (array_key_exists($uid, $this->_states)) {
    	$state = $this->_states[$uid];
    	switch ($state) {
    		case self::ADDED:
    			unset($this->_add[$uid]);
    			break;
    		case self::DIRTY:
    			unset($this->_dirty[$uid]);
    			break;
    		case self::DELETED:
    			unset($this->_delete[$uid]);
    			break;
    		default:
    			break;
    	} 
    }
    $this->_states[$uid] = self::DETACHED;
 	}*/
  
  /**
	 * Sauvegarder le contexte en base de données 
	 */
  public function commit() {
    //
  	foreach ($this->_persist as $obj) {
      $this->_mapper->save($obj);
    }
    //
    foreach ($this->_delete as $obj) {
      $this->_mapper->delete($obj);
    }
   	
   	$this->clear(); 
  }
  
  public function clean()
  {
    $this->_persist = array();
    $this->_delete = array();
  }
  
  /**
   * Obtenir la valeur de l'Id d'une entité
   * @param object $entity
   */
  /*
  private function _getIdentifierValue($entity)
  {
  	// Inspecte l'entité par réflection pour trouver l'Id
  	$class = get_class($entity);
		$reflection = new \ReflectionClass($class);
		$properties = $reflection->getProperties();
		foreach ($properties as $property) {
			$comment = $property->getDocComment();
			if (strpos($comment, '@Id') !== false) {
				if (!$property->isPublic()) {
					$property->setAccessible(true);
				}
				$id = $property->getValue($entity);
				// Retourne l'Id
				return $id;
			}
		}
  }*/
  

	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $entity
	 */
  /*
	private function _calculateKey($entity) {
		$key = get_class($entity) . '-' . $this->_getIdentifierValue($entity);
		return $key;
	}*/
}