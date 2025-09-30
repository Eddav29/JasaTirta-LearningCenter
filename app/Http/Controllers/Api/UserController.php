<?php

namespace App\Http\Controllers\Api;

use App\Data\UserCreationData;
use App\Data\UserUpdateData;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\Contracts\UserManagementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly UserManagementService $service) {}

    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);
        $users = $this->service->listPaginated($perPage); // paginator with roles eager loaded

        return UserResource::collection($users);
    }

    public function store(UserStoreRequest $request)
    {
        $user = $this->service->create(new UserCreationData(
            $request->string('name'),
            $request->string('email'),
            $request->string('password'),
        ), $request->input('roles', []));

        return (new UserResource($user->load('roles')))
            ->additional([])
            ->response()
            ->setStatusCode(201);
    }

    public function show(int $user)
    {
        $found = $this->service->find($user);
        if ($found === null) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return new UserResource($found->load('roles'));
    }

    public function update(UserUpdateRequest $request, int $user)
    {
        $updated = $this->service->update($user, new UserUpdateData(
            $request->string('name'),
            $request->string('email'),
            $request->filled('password') ? $request->string('password') : null,
        ), $request->input('roles'));

        return new UserResource($updated);
    }

    public function destroy(int $user): JsonResponse
    {
        $this->service->delete($user);

        return response()->json(['message' => 'Deleted']);
    }
}
