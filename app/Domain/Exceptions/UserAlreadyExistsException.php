<?php

namespace App\Domain\Exceptions;

class UserAlreadyExistsException extends \DomainException
{
    public function __construct(string $email)
    {
        parent::__construct("User with email {$email} already exists.");
    }
}
