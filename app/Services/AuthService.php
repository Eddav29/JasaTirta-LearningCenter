<?php

namespace App\Services;

use App\Data\UserCreationData;
use App\Domain\Enums\RoleEnum;
use App\Domain\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use App\Services\Contracts\AuthService as AuthServiceContract;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthService implements AuthServiceContract
{
    public function __construct(private readonly UserRepository $users) {}

    public function register(UserCreationData $data, RoleEnum $role = RoleEnum::User): User
    {
        return DB::transaction(function () use ($data, $role): User {
            if ($this->users->findByEmail($data->email) !== null) {
                throw new UserAlreadyExistsException($data->email);
            }

            // Model casts will hash the password; avoid double hashing by passing raw value.
            $user = $this->users->create(new UserCreationData(
                $data->name,
                $data->email,
                $data->password,
            ));

            $roleModel = Role::findByName($role->value);
            $user->assignRole($roleModel);

            return $user;
        });
    }

    public function login(string $email, string $password): string
    {
        $user = $this->users->findByEmail($email);
        if (! $user || ! Hash::check($password, $user->password)) {
            throw new AuthenticationException('Invalid credentials');
        }
        // Single-session policy: revoke all previous tokens before issuing a new one
        $user->tokens()->delete();

        return $user->createToken('api')->plainTextToken;
    }

    public function logout(User $user): void
    {
        $token = $user->currentAccessToken();
        if ($token !== null) {
            // Use relationship to ensure proper deletion without relying on dynamic return type.
            $user->tokens()->where('id', $token->id)->delete();
        }
    }
}
