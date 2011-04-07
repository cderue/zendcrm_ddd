<?php
/**
 * @namespace
 */
namespace Application\Domain\Service;
use \Application\Domain\Object as DomainObject;

/**
 * Service de conversion des prospects
 */
interface ILeadConverterDomainService
{
  public function performConversionToContact();
  public function performConversionToAccount();
	public function performConversionToOpportunity();
}
