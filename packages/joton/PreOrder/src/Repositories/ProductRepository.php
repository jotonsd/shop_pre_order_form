<?php

namespace Joton\PreOrder\Repositories;

use Joton\PreOrder\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    /**
     * ProductRepository constructor.
     *
     * @param \Joton\PreOrder\Models\Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->with('category')->get();
    }

    /**
     * Retrieve a product by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function getById($id)
    {
        return $this->model->with('category')->findOrFail($id);
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\Product
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a product by its ID.
     *
     * @param int $id
     * @param array $data
     * @return \Joton\PreOrder\Models\Product
     */
    public function update($id, array $data)
    {
        $category = $this->getById($id);
        $category->update($data);
        return $category;
    }

    /**
     * Soft delete a product by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
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
     * @return \Joton\PreOrder\Models\Product
     */
    public function restore($id)
    {
        $category = $this->model->onlyTrashed()->findOrFail($id);
        $category->restore();
        return $category;
    }
}
