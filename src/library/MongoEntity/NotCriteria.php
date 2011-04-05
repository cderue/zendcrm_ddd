<?php
/**
 * @namespace
 */
namespace MongoEntity;

class NotSpecification extends AbstractSpecification {
  private $_spec;
  
  public function __construct(ISpecification $spec) {
    $this->_spec = $spec;
  }
  
  public function isSatisfiedBy($candidate) {
    return !$this->spec->isSatisfiedBy($candidate);
  }
}