<?php

namespace Joton\PreOrder\Http\Controllers;

use Exception;
use Throwable;
use Joton\PreOrder\Services\UserService;
use Joton\PreOrder\Http\Requests\UserRequest;

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
        try {
            $users = $this->userSercvice->getAllUsers();
            $this->logResponse(response()->json($users));

            return response()->json($users);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Get a single user by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $user = $this->userSercvice->getUserById($id);
            $this->logResponse(response()->json($user));

            return response()->json($user);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Store a new user user.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        try {
            $this->logRequest($request);
            $user = $this->userSercvice->createUser($request->validated());
            $this->logResponse(response()->json($user));

            return response()->json($user, 201);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
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
        try {
            $this->logRequest($request, $id);
            $user = $this->userSercvice->updateUser($id, $request->validated());
            $this->logResponse(response()->json($user));

            return response()->json($user);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Soft delete a user.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->userSercvice->deleteUser($id);
            $data = ['message' => 'User deleted successfully'];
            $this->logResponse(response()->json($data));

            return response()->json($data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Restore a soft-deleted user.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        try {
            $user = $this->userSercvice->restoreUser($id);
            $this->logResponse(response()->json($user));

            return response()->json($user);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
