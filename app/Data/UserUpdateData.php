<?php

namespace App\Data;

class UserUpdateData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $password = null,
    ) {}
}
