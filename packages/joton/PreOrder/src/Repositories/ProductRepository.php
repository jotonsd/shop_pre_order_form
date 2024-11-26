<?php

namespace Joton\PreOrder\Repositories;

use Exception;
use Joton\PreOrder\Models\Product;
use Throwable;

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
     * Retrieve all products with pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllWithPagination()
    {
        try {
            return $this->model->with('category')->orderBy('id', 'desc')->paginate(10);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Retrieve all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        try {
            return $this->model->get();
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Retrieve a product by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function getById($id)
    {
        try {
            return $this->model->with('category')->findOrFail($id);
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
    public function create(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
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
        try {
            $product = $this->getById($id);
            $product->update($data);

            return $product;
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Soft delete a product by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\Product
     */
    public function delete($id)
    {
        try {
            $product = $this->getById($id);
            $product->delete();

            return $product;
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
    public function restore($id)
    {
        try {
            $product = $this->model->onlyTrashed()->findOrFail($id);
            $product->restore();

            return $product;
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
