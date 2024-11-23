<?php

namespace Joton\PreOrder\Services;

use Joton\PreOrder\Repositories\ProductCategoryRepositoryInterface;

class ProductCategoryService
{
    protected $repository;

    /**
     * ProductCategoryService constructor.
     *
     * @param ProductCategoryRepositoryInterface $repository
     */
    public function __construct(ProductCategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all product categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        return $this->repository->getAll();
    }

    /**
     * Get a product category by ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function getCategoryById($id)
    {
        return $this->repository->getById($id);
    }

    /**
     * Create a new product category.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function createCategory(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Update an existing product category by ID.
     *
     * @param int $id
     * @param array $data
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function updateCategory($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Soft delete a product category.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function deleteCategory($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Restore a soft-deleted product category.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function restoreCategory($id)
    {
        return $this->repository->restore($id);
    }
}
