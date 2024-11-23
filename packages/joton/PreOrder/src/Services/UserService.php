<?php

namespace Joton\PreOrder\Services;

use Exception;
use Joton\PreOrder\Repositories\UserRepositoryInterface;
use Throwable;

class UserService
{
    protected $repository;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        try {
            return $this->repository->getAll();
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Get a user by ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\User
     */
    public function getUserById($id)
    {
        try {
            return $this->repository->getById($id);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Create a new user.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\User
     */
    public function createUser(array $data)
    {
        try {
            return $this->repository->create($data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Update an existing user by ID.
     *
     * @param int $id
     * @param array $data
     * @return \Joton\PreOrder\Models\User
     */
    public function updateUser($id, array $data)
    {
        try {
            return $this->repository->update($id, $data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Soft delete a user.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\User
     */
    public function deleteUser($id)
    {
        try {
            return $this->repository->delete($id);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Restore a soft-deleted user.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\User
     */
    public function restoreUser($id)
    {
        try {
            return $this->repository->restore($id);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
