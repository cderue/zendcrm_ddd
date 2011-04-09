<?php
/**
 * @namespace
 */
namespace Application\Service;
use \Application\Domain\Object as DomainObject;

/**
 * Interface IContactApplicationService
 */
interface IContactApplicationService
{
	public function getContacts();
	public function getContactById($id);
	public function getContactsByCreatorId($creatorId);
	public function addContact(DomainObject\Contact $contact);
	public function modifyContact(DomainObject\Contact $contact);
	public function removeContact(DomainObject\Contact $contact);
}