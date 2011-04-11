<?php
/**
 * @namespace
 */
namespace MongoEntity;

class Connection
{
	protected $_host;
	protected $_port;
	protected $_database;
	protected $_options = array();
	protected $_mongo = null;
	
	public function __construct(
		$host = 'localhost', 
		$port = '27017',
		$database = null,
		$options = array() )
	{
		$this->_host = $host;
		$this->_port = $port;
		$this->_database = $database;
		$this->_options = $options;
	}
	
	public function getDatabase()
	{
		if (empty($this->_database)) {
			throw new \Exception('Invalid database');
		}
		return $this->_getMongo()->selectDB($this->_database);
	}

	private function _getMongo()
	{	
		if (null === $this->_mongo) {
			$server = "mongodb://$this->_host]";
			$this->_mongo = new \Mongo();
		}
		
		return $this->_mongo;
	}
}