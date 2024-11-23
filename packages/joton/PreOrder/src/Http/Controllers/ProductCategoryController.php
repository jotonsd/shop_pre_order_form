<?php

namespace Joton\PreOrder\Http\Controllers;

use Joton\PreOrder\Services\ProductCategoryService;
use Joton\PreOrder\Http\Requests\ProductCategoryRequest;
use App\Http\Controllers\Controller;

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
        $categories = $this->productCategoryService->getAllCategories();
        return response()->json($categories);
    }

    /**
     * Get a single product category by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $category = $this->productCategoryService->getCategoryById($id);
        return response()->json($category);
    }

    /**
     * Store a new product category.
     *
     * @param ProductCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductCategoryRequest $request)
    {
        $category = $this->productCategoryService->createCategory($request->validated());
        return response()->json($category, 201);
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
        $category = $this->productCategoryService->updateCategory($id, $request->validated());
        return response()->json($category);
    }

    /**
     * Soft delete a product category.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->productCategoryService->deleteCategory($id);
        return response()->json(['message' => 'Category deleted successfully']);
    }

    /**
     * Restore a soft-deleted product category.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $category = $this->productCategoryService->restoreCategory($id);
        return response()->json($category);
    }
}
