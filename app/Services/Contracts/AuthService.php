<?php

namespace App\Services\Contracts;

use App\Data\UserCreationData;
use App\Domain\Enums\RoleEnum;
use App\Models\User;

interface AuthService
{
    /**
     * Register a new user and assign a role.
     */
    public function register(UserCreationData $data, RoleEnum $role = RoleEnum::User): User;

    /**
     * Attempt login and return a plain text API token.
     */
    public function login(string $email, string $password): string;

    /**
     * Revoke current access token for the user (logout current device).
     */
    public function logout(User $user): void;
}
