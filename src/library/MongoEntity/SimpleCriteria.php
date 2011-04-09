<?php
/**
 * @namespace
 */
namespace MongoEntity;
/**
 * Critère simple
 */
class SimpleCriteria implements ICriteria
{
	/**
	 * Champ
	 * @var mixed
	 */
	private $_field = null;
	/**
	 * Opérateur
	 * @var string
	 */
	private $_operator = null;
	/**
	 * Valeur
	 * @var string
	 */
	private $_value = null;
	
	/**
	 * Constructeur
	 * @param mixed $field
	 * @param string $operator
	 * @param string $value
	 */
	public function __construct($field, $operator, $value)
	{
		$this->_field = $field;
		$this->_operator = $operator;
		$this->_value = $value;
	}
	
	public function getExpression()
	{
		return "(this.$this->_field" . " " . "$this->_operator" . " " . "$this->_value)";
	}
}