<?php
/**
 * @namespace
 */
namespace MongoEntity;

class AndSpecification extends AbstractSpecification {
  private $_one; 
  private $_other;
  
  public function __construct(ISpecification $one, ISpecification $other) {
    $this->_one = $one;
    $this->_other = $other;
  }
  
  public function isSatisfiedBy($candidate) {
    return $this->_one->isSatisfiedBy($candidate) && $this->_one->isSatisfiedBy($candidate);
  }
}