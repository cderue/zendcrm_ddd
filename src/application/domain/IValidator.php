<?php

namespace Application\Domain\Contract;

interface IValidator
{
	public function isValid();
	public function getErrors();
}