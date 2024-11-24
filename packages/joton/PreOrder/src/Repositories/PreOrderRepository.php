<?php

namespace Joton\PreOrder\Repositories;

use Exception;
use Throwable;
use Illuminate\Support\Facades\DB;
use Joton\PreOrder\Models\Product;
use Joton\PreOrder\Models\PreOrder;
use Joton\PreOrder\Models\PreOrderDetail;
use Illuminate\Database\Eloquent\Collection;
use Joton\PreOrder\Events\PreOrderSubmitted;

class PreOrderRepository implements PreOrderRepositoryInterface
{
    protected const ADMIN_MAIL = 'jotonsutradharjoy@gmail.com';

    protected $model;

    /**
     * PreOrderRepository constructor.
     *
     * @param \Joton\PreOrder\Models\PreOrder $model
     */
    public function __construct(PreOrder $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all pre-orders.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): Collection
    {
        try {
            return $this->model->with('details')->get();
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Retrieve all pre-orders.
     *
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBySearchedQuery(string $query): Collection
    {
        try {
            return $this->model->select('*', DB::raw("LEAST(
                        POSITION('{$query}' IN LOWER(name)),
                        POSITION('{$query}' IN LOWER(email))
                    ) AS position
                "))
                ->where(function ($q) use ($query) {
                    $q->where('name', 'ILIKE', "%{$query}%")
                        ->orWhere('email', 'ILIKE', "%{$query}%");
                })
                ->orderBy('position', 'desc')
                ->with('details')
                ->get();
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Retrieve a pre-order by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function getById($id): PreOrder
    {
        try {
            return $this->model->with('details')->findOrFail($id);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Create a new pre-order.
     *
     * @param array $data
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function create(array $data): PreOrder
    {
        // Start the transaction
        DB::beginTransaction();

        try {
            $orderId = PreOrder::insertGetid([
                "name" => $data['name'],
                "email" => $data['email'],
                "phone" => $data['phone'] ?? null,
            ]);

            foreach ($data['details'] as $details) {
                $price = Product::find($details['product_id'])->value('price');

                PreOrderDetail::insert([
                    "pre_order_id" => $orderId,
                    "product_id" => $details['product_id'],
                    "quantity" => $details['quantity'],
                    "unit_price" => $price,
                    "total_price" => $details['quantity'] * $price
                ]);
            }
            DB::commit();

            $mailData = PreOrder::with('details')->find($orderId)->toArray();

            $mailData['admin_email'] = self::ADMIN_MAIL;

            // Dispatch the event
            PreOrderSubmitted::dispatch($mailData);

            return PreOrder::with('details')->find($orderId);
        } catch (Throwable $th) {
            DB::rollBack();

            throw new Exception($th);
        }
    }

    /**
     * Update a pre-order by its ID.
     *
     * @param int $id
     * @param array $data
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function update($id, array $data): PreOrder
    {
        $order = $this->getById($id);

        // Start the transaction
        DB::beginTransaction();

        try {
            // Update order details
            $order->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
            ]);

            // Update or create order details
            foreach ($data['details'] as $detail) {

                if (!empty($detail['pre_order_details_id'])) {
                    PreOrderDetail::findOrFail($detail['pre_order_details_id'])->delete();
                } else {
                    $price = Product::find($detail['product_id'])->value('price');
                    PreOrderDetail::updateOrCreate(
                        [
                            'pre_order_id' => $order->id,
                            'product_id' => $detail['product_id'],
                        ],
                        [
                            'quantity' => $detail['quantity'],
                            'unit_price' => $price,
                            'total_price' => $detail['quantity'] * $price,
                        ]
                    );
                }
            }
            DB::commit();

            return PreOrder::with('details')->find($order->id);
        } catch (Throwable $th) {
            DB::rollBack();

            throw new Exception($th);
        }
    }

    /**
     * Soft delete a pre-order by its ID.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function delete($id): PreOrder
    {
        try {
            $order = $this->getById($id);
            $order->details()->delete();
            $order->delete();

            return $order;
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Restore a soft-deleted order.
     *
     * @param int $id
     * @return \Joton\PreOrder\Models\PreOrder
     */
    public function restore($id): PreOrder
    {
        try {
            $order = $this->model->onlyTrashed()->with('details')->findOrFail($id);
            $order->restore();
            $order->details()->withTrashed()->restore();

            return $this->getById($id);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
