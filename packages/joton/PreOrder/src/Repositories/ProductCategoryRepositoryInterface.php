<?php

namespace Joton\PreOrder\Repositories;

interface ProductCategoryRepositoryInterface
{
    /**
     * Get all product categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Get a product category by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function getById($id);

    /**
     * Create a new product category.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function create(array $data);

    /**
     * Update an existing product category by its ID.
     *
     * @param int $id
     * @param array $data
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function update($id, array $data);

    /**
     * Soft delete a product category by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function delete($id);

    /**
     * Restore a soft-deleted product category.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\ProductCategory
     */
    public function restore($id);
}
