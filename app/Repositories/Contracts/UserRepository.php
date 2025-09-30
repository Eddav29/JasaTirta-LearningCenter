<?php

namespace App\Repositories\Contracts;

use App\Data\UserCreationData;
use App\Data\UserUpdateData;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepository
{
    public function create(UserCreationData $data): User;

    public function findByEmail(string $email): ?User;

    public function findById(int $id): ?User;

    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function all(): Collection;

    public function update(User $user, UserUpdateData $data): User;

    public function delete(User $user): void;
}
