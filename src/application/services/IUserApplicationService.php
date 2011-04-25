<?php
/**
 * @namespace
 */
namespace Application\Service;
use \Application\Domain\Object as DomainObject;

/**
 * Interface IUserApplicationService
 */
interface IUserApplicationService
{
	public function getUsers();
	public function getUserById($id);
	public function authenticate($login, $password);
	public function addUser(DomainObject\User $user);
	public function modifyUser(DomainObject\User $user);
	public function removeUser(DomainObject\User $user);
}