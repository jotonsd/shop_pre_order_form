<?php

namespace Joton\PreOrder\Services;

use Exception;
use Throwable;
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
     * Get all product categories with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        try {
            return $this->repository->getAllWithPagination();
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Get all product categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        try {
            return $this->repository->getAll();
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Get a product category by ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function getCategoryById($id)
    {
        try {
            return $this->repository->getById($id);
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
    public function createCategory(array $data)
    {
        try {
            return $this->repository->create($data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
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
        try {
            return $this->repository->update($id, $data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Soft delete a product category.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function deleteCategory($id)
    {
        try {
            return $this->repository->delete($id);
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
    public function restoreCategory($id)
    {
        try {
            return $this->repository->restore($id);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
