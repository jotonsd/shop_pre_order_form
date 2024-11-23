<?php

namespace Joton\PreOrder\Repositories;

use App\Models\User;
use Exception;
use Throwable;

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
        try {
            return $this->model->all();
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Retrieve a user by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\User
     */
    public function getById($id)
    {
        try {
            return $this->model->findOrFail($id);
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
    public function create(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
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
        try {
            $user = $this->getById($id);
            $user->update($data);

            return $user;
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Soft delete a user by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\User
     */
    public function delete($id)
    {
        try {
            $user = $this->getById($id);
            $user->delete();

            return $user;
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
    public function restore($id)
    {
        try {
            $user = $this->model->onlyTrashed()->findOrFail($id);
            $user->restore();
            return $user;
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
