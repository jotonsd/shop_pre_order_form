<?php

namespace Joton\PreOrder\Repositories;

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
        return $this->model->with('products')->get();
    }

    /**
     * Retrieve a product category by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function getById($id)
    {
        return $this->model->with('products')->findOrFail($id);
    }

    /**
     * Create a new product category.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function create(array $data)
    {
        return $this->model->create($data);
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
        $category = $this->getById($id);
        $category->update($data);
        return $category;
    }

    /**
     * Soft delete a product category by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function delete($id)
    {
        $category = $this->getById($id);
        $category->delete();
        return $category;
    }

    /**
     * Restore a soft-deleted product category.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function restore($id)
    {
        $category = $this->model->onlyTrashed()->findOrFail($id);
        $category->restore();
        return $category;
    }
}
