<?php

namespace App\Http\Controllers\Api;

use App\Data\UserCreationData;
use App\Domain\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Contracts\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $auth) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = new UserCreationData(
            $request->string('name'),
            $request->string('email'),
            $request->string('password'),
        );

        $roleValue = $request->string('role', 'user');
        $roleEnum = RoleEnum::tryFrom($roleValue) ?? RoleEnum::User;
        $user = $this->auth->register($data, $roleEnum);

        return response()->json([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->getRoleNames(),
            ],
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $token = $this->auth->login(
                $request->string('email'),
                $request->string('password')
            );
        } catch (AuthenticationException) {
            return response()->json(['message' => 'Credentials invalid'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->getRoleNames(),
            ],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->auth->logout($request->user());

        return response()->json(['message' => 'Logged out']);
    }
}
