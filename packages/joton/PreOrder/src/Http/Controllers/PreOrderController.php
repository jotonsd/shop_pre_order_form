<?php

namespace Joton\PreOrder\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Joton\PreOrder\Services\PreOrderService;
use Joton\PreOrder\Http\Requests\PreOrderRequest;
use Throwable;

class PreOrderController extends Controller
{
    protected $preOrderService;

    /**
     * PreOrderController constructor.
     *
     * @param PreOrderService $preOrderService
     */
    public function __construct(PreOrderService $preOrderService)
    {
        $this->preOrderService = $preOrderService;
    }

    /**
     * Get all pre-orders.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $preOrders = $this->preOrderService->getAllPreOrders();
            $this->logResponse(response()->json($preOrders));

            return response()->json($preOrders);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Get a single pre-order by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $preOrder = $this->preOrderService->getPreOrderById($id);
            $this->logResponse(response()->json($preOrder));

            return response()->json($preOrder);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Store a new pre-order.
     *
     * @param PreOrderRequest $request
     * @return JsonResponse
     */
    public function store(PreOrderRequest $request): JsonResponse
    {
        try {
            $this->logRequest($request);
            $preOrder = $this->preOrderService->createPreOrder($request->validated());
            $this->logResponse(response()->json($preOrder));

            return response()->json($preOrder, 201);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Update an existing pre-order.
     *
     * @param PreOrderRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(PreOrderRequest $request, int $id): JsonResponse
    {
        try {
            $this->logRequest($request, $id);
            $preOrder = $this->preOrderService->updatePreOrder($id, $request->validated());
            $this->logResponse(response()->json($preOrder));

            return response()->json($preOrder);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Soft delete a pre-order.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->preOrderService->deletePreOrder($id);
            $data = ['message' => 'Pre-order deleted successfully'];
            $this->logResponse(response()->json($data));

            return response()->json($data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Restore a soft-deleted pre-order.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore($id): JsonResponse
    {
        try {
            $preOrder = $this->preOrderService->restorePreOrder($id);
            $this->logResponse(response()->json($preOrder));
            
            return response()->json($preOrder);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
