<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Services\Api\CategoriesApiService;

class CategoriesApiController
{
    private CategoriesApiService $categoriesApiService;

    public function __construct(CategoriesApiService $categoriesApiService)
    {
        $this->categoriesApiService = $categoriesApiService;
    }

    /**
     * @OA\Get(
     *     security={ {"sanctum": {} }},
     * path="/api/v1/categories",
     * summary="All categories",
     * description="Output all the categories",
     * tags={"Category"},
     * @OA\Response(
     *    response=200,
     *    description="Successfully done request"
     *   )
     * )
     */
    public function index()
    {
       return $this->categoriesApiService->getAll();
    }

    /**
     * @OA\Get(
     *     security={ {"sanctum": {} }},
     * path="/api/v1/categories/{categoryId}",
     * summary="Find category by id",
     * description="Output the category by id",
     * tags={"Category"},
     * @OA\Parameter(
     *      name="categoryId",
     *      in="path",
     *      description="ID of category that needs to be shwon",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64"
     *      )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Successfully done request"
     *   )
     * )
     */
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
