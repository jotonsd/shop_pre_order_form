<?php

namespace Joton\PreOrder\Services;

use Exception;
use Joton\PreOrder\Repositories\ProductRepositoryInterface;
use Throwable;

class ProductService
{
    protected $repository;

    /**
     * ProductService constructor.
     *
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts()
    {
        try {
            return $this->repository->getAll();
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Get a product by ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function getProductById($id)
    {
        try {
            return $this->repository->getById($id);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\Product
     */
    public function createProduct(array $data)
    {
        try {
            return $this->repository->create($data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Update an existing product by ID.
     *
     * @param int $id
     * @param array $data
     * @return \Joton\PreOrder\Models\Product
     */
    public function updateProduct($id, array $data)
    {
        try {
            return $this->repository->update($id, $data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Soft delete a product.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function deleteProduct($id)
    {
        try {
            return $this->repository->delete($id);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Restore a soft-deleted product.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function restoreProduct($id)
    {
        try {
            return $this->repository->restore($id);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
