<?php

namespace Joton\PreOrder\Services;

use Illuminate\Database\Eloquent\Collection;
use Joton\PreOrder\Models\PreOrder;
use Joton\PreOrder\Repositories\PreOrderRepositoryInterface;

class PreOrderService
{
    protected $repository;

    /**
     * PreOrderService constructor.
     *
     * @param PreOrderRepositoryInterface $repository
     */
    public function __construct(PreOrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all pre-orders.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPreOrders()
    {
        return $this->repository->getAll();
    }

    /**
     * Get pre-orders by searched query.
     *
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPreOrderBySearchedQuery(string $query)
    {
        return $this->repository->getBySearchedQuery($query);
    }

    /**
     * Get a pre-order by ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function getPreOrderById($id): PreOrder
    {
        return $this->repository->getById($id);
    }

    /**
     * Create a new pre-order.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function createPreOrder(array $data): PreOrder
    {
        return $this->repository->create($data);
    }

    /**
     * Update an existing pre-order by ID.
     *
     * @param int $id
     * @param array $data
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function updatePreOrder($id, array $data): PreOrder
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Soft delete a pre-order.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function deletePreOrder($id): PreOrder
    {
        return $this->repository->delete($id);
    }

    /**
     * Restore a soft-deleted pre-order.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function restorePreOrder($id): PreOrder
    {
        return $this->repository->restore($id);
    }
}
