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
     *    description="OK",
     *   ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated.",
     *      ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
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
     *    description="OK"
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated."
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show($id)
    {
        return $this->categoriesApiService->getById($id);
    }

    /**
     * @OA\Post(
     *     security={ {"sanctum": {} }},
     * path="/api/v1/categories",
     * summary="Store new category",
     * description="Store new category",
     * operationId="createNewCategory",
     * tags={"Category"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Enter category name",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="Qwerty"),
     *    ),
     * ),
     *   @OA\Response(
     *      response=201,
     *       description="Successfully stored",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated."
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function store(CategoryRequest $request)
    {
        return $this->categoriesApiService->store($request);
    }

    /**
     * @OA\Patch(
     *     security={ {"sanctum": {} }},
     * path="/api/v1/categories/{categoryId}",
     * summary="Update category by id",
     * description="Update category by id",
     * operationId="updateCategory",
     * tags={"Category"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Enter new category values",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="QWERTY"),
     *    ),
     * ),
     * @OA\Parameter(
     *      name="categoryId",
     *      in="path",
     *      description="ID of category that needs to be updated",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64"
     *      )
     * ),
     *   @OA\Response(
     *      response=201,
     *       description="Successfully updated",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function update($id, CategoryRequest $request)
    {
        return $this->categoriesApiService->update($id, $request);
    }

    /**
     * @OA\Delete(
     *     security={ {"sanctum": {} }},
     * path="/api/v1/categories/{categoryId}",
     * summary="Delete category by id",
     * description="Delete category by id",
     * operationId="deleteCategory",
     * tags={"Category"},
     * @OA\Parameter(
     *      name="categoryId",
     *      in="path",
     *      description="ID of category that needs to be deleted",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64"
     *      )
     * ),
     *   @OA\Response(
     *      response=201,
     *       description="Successfully deleted",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function destroyById(int $id)
    {
        return $this->categoriesApiService->destroyById($id);
    }

    /**
     * @OA\Delete(
     *     security={ {"sanctum": {} }},
     * path="/api/v1/categories",
     * summary="Delete all categories",
     * description="Delete all categories",
     * operationId="deleteAllCategories",
     * tags={"Category"},
     *   @OA\Response(
     *      response=201,
     *       description="Successfully deleted",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function destroy()
    {
        return $this->categoriesApiService->destroy();
    }
}
