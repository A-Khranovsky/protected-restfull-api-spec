<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Services\Api\CategoriesApiService;

/**
 * @OA\Get(
 * path="/api/v1/categories",
 * summary="All categories",
 * description="Out put all the categories",
 * @OA\Response(
 *    response=200,
 *    description="Successfully done request"
 *   )
 * )
 */



class CategoriesApiController
{
    private CategoriesApiService $categoriesApiService;

    public function __construct(CategoriesApiService $categoriesApiService)
    {
        $this->categoriesApiService = $categoriesApiService;
    }

    public function index()
    {
       return $this->categoriesApiService->getAll();
    }

    public function show($id)
    {
        return $this->categoriesApiService->getById($id);
    }

    public function store(CategoryRequest $request)
    {
        return $this->categoriesApiService->store($request);
    }

    public function update($id, CategoryRequest $request)
    {
        return $this->categoriesApiService->update($id, $request);
    }

    public function destroyById(int $id)
    {
        return $this->categoriesApiService->destroyById($id);
    }

    public function destroy()
    {
        return $this->categoriesApiService->destroy();
    }
}
