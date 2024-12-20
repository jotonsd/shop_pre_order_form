<?php

namespace Joton\PreOrder\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Joton\PreOrder\Models\PreOrder;

interface PreOrderRepositoryInterface
{
    /**
     * Get all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Get pre-orders by searched query.
     *
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBySearchedQuery(string $query);

    /**
     * Get a product by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function getById($id);

    /**
     * Create a new product.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function create(array $data);

    /**
     * Update an existing product by its ID.
     *
     * @param int $id
     * @param array $data
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function update($id, array $data);

    /**
     * Soft delete a product by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function delete($id);

    /**
     * Restore a soft-deleted product.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function restore($id);
}
