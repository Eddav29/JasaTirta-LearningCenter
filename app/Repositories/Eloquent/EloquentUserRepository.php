<?php

namespace App\Repositories\Eloquent;

use App\Data\UserCreationData;
use App\Data\UserUpdateData;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;

class EloquentUserRepository implements UserRepository
{
    public function create(UserCreationData $data): User
    {
        return User::query()->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        return User::query()->where('email', $email)->first();
    }

    public function findById(int $id): ?User
    {
        return User::query()->with('roles')->find($id);
    }

    public function paginate(int $perPage = 15): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return User::query()->with('roles')->paginate($perPage);
    }

    public function all(): \Illuminate\Support\Collection
    {
        return User::query()->with('roles')->get();
    }

    public function update(User $user, UserUpdateData $data): User
    {
        $payload = [
            'name' => $data->name,
            'email' => $data->email,
        ];
        if ($data->password !== null) {
            $payload['password'] = $data->password; // cast will hash
        }
        $user->update($payload);

        return $user->refresh();
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
