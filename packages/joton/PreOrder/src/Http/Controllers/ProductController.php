<?php

namespace Joton\PreOrder\Http\Controllers;

use Exception;
use Joton\PreOrder\Services\ProductService;
use Joton\PreOrder\Http\Requests\ProductRequest;
use Throwable;

class ProductController extends Controller
{
    protected $productService;

    /**
     * ProductController constructor.
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Get all products.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $products = $this->productService->getAllProducts();
            $this->logResponse(response()->json($products));

            return response()->json($products);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Get a single product by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $product = $this->productService->getProductById($id);
            $this->logResponse(response()->json($product));

            return response()->json($product);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Store a new product product.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        try {
            $this->logRequest($request);
            $product = $this->productService->createProduct($request->validated());
            $this->logResponse(response()->json($product));

            return response()->json($product, 201);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Update an existing product.
     *
     * @param ProductRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $this->logRequest($request, $id);
            $product = $this->productService->updateProduct($id, $request->validated());
            $this->logResponse(response()->json($product));

            return response()->json($product);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Soft delete a product.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->productService->deleteProduct($id);
            $data = ['message' => 'Product deleted successfully'];
            $this->logResponse(response()->json($data));

            return response()->json($data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Restore a soft-deleted product.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        try {
            $product = $this->productService->restoreProduct($id);
            $this->logResponse(response()->json($product));

            return response()->json($product);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
