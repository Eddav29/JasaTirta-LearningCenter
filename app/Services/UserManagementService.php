<?php

namespace App\Services;

use App\Data\UserCreationData;
use App\Data\UserUpdateData;
use App\Domain\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use App\Services\Contracts\UserManagementService as UserManagementServiceContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserManagementService implements UserManagementServiceContract
{
    public function __construct(private readonly UserRepository $users) {}

    public function listPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->users->paginate($perPage);
    }

    public function listAll(): Collection
    {
        return $this->users->all();
    }

    public function create(UserCreationData $data, array $roles = []): User
    {
        return DB::transaction(function () use ($data, $roles): User {
            $user = $this->users->create($data);
            if ($roles !== []) {
                $validRoles = Role::query()->whereIn('name', $roles)->pluck('name')->all();
                $user->syncRoles($validRoles);
            }

            return $user;
        });
    }

    public function find(int $id): ?User
    {
        return $this->users->findById($id);
    }

    public function update(int $id, UserUpdateData $data, ?array $roles = null): User
    {
        return DB::transaction(function () use ($id, $data, $roles): User {
            $user = $this->users->findById($id);
            if ($user === null) {
                throw new UserNotFoundException($id);
            }
            $this->users->update($user, $data);
            if ($roles !== null) {
                $validRoles = Role::query()->whereIn('name', $roles)->pluck('name')->all();
                $user->syncRoles($validRoles);
            }

            return $user->load('roles');
        });
    }

    public function delete(int $id): void
    {
        $user = $this->users->findById($id);
        if ($user === null) {
            return; // idempotent
        }
        $this->users->delete($user);
    }
}
