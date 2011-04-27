<?php
/**
 * @namespace
 */
namespace MongoEntity;

/**
 * Objet de requête
 */
class QueryObject
{
	/**
	 * 
	 * @var unknown_type
	 */
	private $_collection = null;
	/**
	 * 
	 * @var unknown_type
	 */
	private $_criterias = array();
	/**
	 * 
	 * @var unknown_type
	 */
	private $_where = null;
	/**
	 * 
	 * @var unknown_type
	 */
	private $_context = null;
	/**
	 * 
	 * @var unknown_type
	 */
	private $_entityClassName = null;
	
	/**
	 * Constructeur
	 * @param EntityContext $context
	 */
	public function __construct(EntityContext $context)
	{
		$this->_context = $context;
	}
	
	/**
	 * Ajouter un critère de filtrage
	 * @param ICriteria $criteria
	 */
	public function addCriteria(ICriteria $criteria)
	{
		$this->_criterias[] = $criteria;
		return $this;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	private function getFilterExpression()
	{
		$implode = array();
		
		if (count($this->_criterias)) {
			foreach ($this->_criterias as $criteria) {
				$implode[] = $criteria->getExpression();
			}
			$js = 'function() { return ';
			$js .= implode(' && ', $implode);
    	$js .= '; }';
    	
    	$expression = array('$where' => $js);
    	
    	return $expression;
		}
	}
	
	/**
	 * Obtenir toutes les entités qui satisfont tous les critères
	 */
	public function select($entityClassName)
	{
		$expression = $this->getFilterExpression();
		$entities = $this->_context->getMapper()->findMany($entityClassName, $expression);
		
		return $entities;
	}
	
	/**
	 * Obtenir la première entité qui satisfait tous les critères
	 */
	public function first($entityClassName)
	{
		$expression = $this->getFilterExpression();
		$entity = $this->_context->getMapper()->findOne($entityClassName, $expression); 
		
		return $entity;
	}
}