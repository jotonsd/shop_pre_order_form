<?php

namespace Joton\PreOrder\Http\Controllers;

use Joton\PreOrder\Services\ProductCategoryService;
use Joton\PreOrder\Http\Requests\ProductCategoryRequest;
use Exception;
use Throwable;

class ProductCategoryController extends Controller
{
    protected $productCategoryService;

    /**
     * ProductCategoryController constructor.
     *
     * @param ProductCategoryService $productCategoryService
     */
    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->productCategoryService = $productCategoryService;
    }

    /**
     * Get all product categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $categories = $this->productCategoryService->getAllCategories();
            $this->logResponse(response()->json($categories));

            return response()->json($categories);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Get a single product category by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $category = $this->productCategoryService->getCategoryById($id);
            $this->logResponse(response()->json($category));

            return response()->json($category);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Store a new product category.
     *
     * @param ProductCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductCategoryRequest $request)
    {
        try {
            $this->logRequest($request);
            $category = $this->productCategoryService->createCategory($request->validated());
            $this->logResponse(response()->json($category));

            return response()->json($category, 201);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Update an existing product category.
     *
     * @param ProductCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductCategoryRequest $request, $id)
    {
        try {
            $this->logRequest($request);
            $category = $this->productCategoryService->updateCategory($id, $request->validated());
            $this->logResponse(response()->json($category));

            return response()->json($category);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Soft delete a product category.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->productCategoryService->deleteCategory($id);
            $data = ['message' => 'Category deleted successfully'];
            $this->logResponse(response()->json($data));

            return response()->json($data);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Restore a soft-deleted product category.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        try {
            $category = $this->productCategoryService->restoreCategory($id);
            $this->logResponse(response()->json($category));

            return response()->json($category);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
