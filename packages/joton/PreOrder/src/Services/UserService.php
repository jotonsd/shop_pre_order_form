<?php

namespace Joton\PreOrder\Services;

use Joton\PreOrder\Repositories\UserRepositoryInterface;

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
        return $this->repository->getAll();
    }

    /**
     * Get a user by ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\User
     */
    public function getUserById($id)
    {
        return $this->repository->getById($id);
    }

    /**
     * Create a new user.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\User
     */
    public function createUser(array $data)
    {
        return $this->repository->create($data);
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
        return $this->repository->update($id, $data);
    }

    /**
     * Soft delete a user.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\User
     */
    public function deleteUser($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Restore a soft-deleted user.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\User
     */
    public function restoreUser($id)
    {
        return $this->repository->restore($id);
    }
}
