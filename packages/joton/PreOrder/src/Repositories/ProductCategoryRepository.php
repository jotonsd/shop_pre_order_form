<?php

namespace Joton\PreOrder\Repositories;

use Exception;
use Throwable;
use Joton\PreOrder\Models\ProductCategory;

class ProductCategoryRepository implements ProductCategoryRepositoryInterface
{
    protected $model;

    /**
     * ProductCategoryRepository constructor.
     *
     * @param \Joton\PreOrder\Models\ProductCategory $model
     */
    public function __construct(ProductCategory $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all product categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        try {
            return $this->model->with('products')->get();
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Retrieve a product category by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function getById($id)
    {
        try {
            return $this->model->with('products')->findOrFail($id);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Create a new product category.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\ProductCategory
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
     * Update a product category by its ID.
     *
     * @param int $id
     * @param array $data
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function update($id, array $data)
    {
        try {
            $category = $this->getById($id);
            $category->update($data);

            return $category;
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Soft delete a product category by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function delete($id)
    {
        try {
            $category = $this->getById($id);
            $category->delete();

            return $category;
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Restore a soft-deleted product category.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function restore($id)
    {
        try {
            $category = $this->model->onlyTrashed()->findOrFail($id);
            $category->restore();

            return $category;
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
