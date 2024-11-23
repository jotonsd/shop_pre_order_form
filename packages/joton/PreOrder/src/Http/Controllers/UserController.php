<?php

namespace Joton\PreOrder\Http\Controllers;

use Joton\PreOrder\Services\UserService;
use Joton\PreOrder\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $userSercvice;

    /**
     * UserController constructor.
     *
     * @param UserService $userSercvice
     */
    public function __construct(UserService $userSercvice)
    {
        $this->userSercvice = $userSercvice;
    }

    /**
     * Get all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = $this->userSercvice->getAllUsers();
        return response()->json($users);
    }

    /**
     * Get a single user by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = $this->userSercvice->getUserById($id);
        return response()->json($user);
    }

    /**
     * Store a new user user.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $user = $this->userSercvice->createUser($request->validated());
        return response()->json($user, 201);
    }

    /**
     * Update an existing user.
     *
     * @param UserRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->userSercvice->updateUser($id, $request->validated());
        return response()->json($user);
    }

    /**
     * Soft delete a user.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->userSercvice->deleteUser($id);
        return response()->json(['message' => 'User deleted successfully']);
    }

    /**
     * Restore a soft-deleted user.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $user = $this->userSercvice->restoreUser($id);
        return response()->json($user);
    }
}
