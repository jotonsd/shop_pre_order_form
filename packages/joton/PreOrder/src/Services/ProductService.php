<?php

namespace Joton\PreOrder\Services;

use Joton\PreOrder\Repositories\ProductRepositoryInterface;

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
        return $this->repository->getAll();
    }

    /**
     * Get a product by ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function getProductById($id)
    {
        return $this->repository->getById($id);
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\Product
     */
    public function createProduct(array $data)
    {
        return $this->repository->create($data);
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
        return $this->repository->update($id, $data);
    }

    /**
     * Soft delete a product.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function deleteProduct($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Restore a soft-deleted product.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function restoreProduct($id)
    {
        return $this->repository->restore($id);
    }
}
