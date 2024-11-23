<?php

namespace Joton\PreOrder\Repositories;

interface UserRepositoryInterface
{
    /**
     * Get all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Get a product by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function getById($id);

    /**
     * Create a new product.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\Product
     */
    public function create(array $data);

    /**
     * Update an existing product by its ID.
     *
     * @param int $id
     * @param array $data
     * @return \Joton\PreOrder\Models\Product
     */
    public function update($id, array $data);

    /**
     * Soft delete a product by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function delete($id);

    /**
     * Restore a soft-deleted product.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function restore($id);
}
