<?php

namespace MongoEntity;

interface IUnitOfWork
{
	public function persistEntity($entity);
	public function deleteEntity($entity);
	public function commit();
	public function clean();
}