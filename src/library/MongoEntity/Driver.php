<?php

namespace MongoEntity;

class Driver
{
	protected $_config = array();
  protected $_connection = null;
  
  public function getConnection()
  {
      return $this->_connection;
  }

  public function getConfig()
  {
      return $this->_config;
  }
	
	public function __construct(Connection $connection)
  {
    /*if (!is_array($config)) {
        if ($config instanceof \Zend\Config\Config) {
            $config = $config->toArray();
        } else {
            throw new \Exception('Adapter parameters must be in an array or a Zend\Config object');
        }
    }*/

    //$this->_checkRequiredOptions($config);
    //$this->_config = array_merge($this->_config, $config);
    // Crée une nouvelle connexion à MongoDB
    //$mongo = new \Mongo();
    $this->_connection = $connection->getDatabase();
    // Sélectionne la base de données 'zendcrm'
    
  }  
  /*
  protected function _checkRequiredOptions(array $config)
  {
  	if (!array_key_exists('dbname', $config)) {
          throw new \Exception("Configuration array must have a key for 'dbname' that names the database instance");
      }

      if (!array_key_exists('password', $config)) {
          throw new \Exception("Configuration array must have a key for 'password' for login credentials");
      }

      if (!array_key_exists('username', $config)) {
          throw new \Exception("Configuration array must have a key for 'username' for login credentials");
      }
  }*/
  
  /*protected function connect()
  {
    $this->__construct();
  }*/
  
  public function insertDocument($collection, array $document)
  {
      $result = $this->getConnection()->$collection->insert($document);
      return $result;
  }

  public function updateDocument($collection, array $criteria, array $values)
  {
      $result = $this->getConnection()->$collection->update($criteria, $values);
      return $result;
  }

  public function deleteDocument($collection, array $criteria, array $options)
  {
      $result = $this->getConnection()->$collection->delete($criteria, $options);;
      return $result;
  }

  public function findMany($collection, array $criteria, array $fields = array())
  {  
      return $this->getConnection()->$collection->find($criteria, $fields);
  }

  public function findOne($collection, array $criteria, array $fields = array())
  {
  	$result = $this->getConnection()->$collection->findOne($criteria, $fields);
    return $result;
  }
  
  public function getDBRef($collection, array $dbRef)
  {
  	$result = $this->getConnection()->$collection->getDBRef($dbRef);
  	return $result;
  }
  
  public function dropDatabase()
  {
    $this->getConnection()->drop();
  }
}
