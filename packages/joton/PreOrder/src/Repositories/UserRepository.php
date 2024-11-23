<?php

namespace Joton\PreOrder\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param \Joton\PreOrder\Models\User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Retrieve a user by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\User
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a new user.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\User
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a user by its ID.
     *
     * @param int $id
     * @param array $data
     * @return \Joton\PreOrder\Models\User
     */
    public function update($id, array $data)
    {
        $category = $this->getById($id);
        $category->update($data);
        return $category;
    }

    /**
     * Soft delete a user by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\User
     */
    public function delete($id)
    {
        $category = $this->getById($id);
        $category->delete();
        return $category;
    }

    /**
     * Restore a soft-deleted category.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\User
     */
    public function restore($id)
    {
        $category = $this->model->onlyTrashed()->findOrFail($id);
        $category->restore();
        return $category;
    }
}
