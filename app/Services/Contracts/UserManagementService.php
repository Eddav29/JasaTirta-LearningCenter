<?php

namespace App\Services\Contracts;

use App\Data\UserCreationData;
use App\Data\UserUpdateData;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserManagementService
{
    public function listPaginated(int $perPage = 15): LengthAwarePaginator;

    public function listAll(): Collection;

    public function create(UserCreationData $data, array $roles = []): User;

    public function find(int $id): ?User;

    public function update(int $id, UserUpdateData $data, ?array $roles = null): User;

    public function delete(int $id): void;
}
