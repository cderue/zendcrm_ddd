<?php
/**
 * @namespace
 */
namespace Application\Service;
use \Application\Domain\Object as DomainObject;

/**
 * Interface IAccountApplicationService
 */
interface IAccountApplicationService
{
	//public function getAccounts();
	public function getAccountById($id);
	public function getAccountsByCreatorId($creatorId);
	public function addAccount(DomainObject\Account $account);
	public function modifyAccount(DomainObject\Account $account);
	public function removeAccount(DomainObject\Account $account);
}