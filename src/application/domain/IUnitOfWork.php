<?php

namespace Application\Domain\Contract;

interface IUnitOfWork
{
	public function commit();
	public function rollback();
}