<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\CategoriesApiService;

use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        return $this->categoriesApiService->store($request);
    }

    public function update($id, Request $request)
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
