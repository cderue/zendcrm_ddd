<?php
/**
 * @namespace
 */
namespace MongoEntity;
/**
 * Interface ICriteria
 */
interface ICriteria 
{
  /**
   * Obtenir l'expression correspondante au critère
   */
	public function getExpression();
}