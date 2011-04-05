<?php

namespace MongoEntity;

interface IUnitOfWork
{
	public function addEntity($entity);
	public function updateEntity($entity);
	public function deleteEntity($entity);
	public function attachEntity($entity);
	public function detachEntity($entity);
	public function persist();
	public function clean();
}