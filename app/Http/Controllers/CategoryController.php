<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategorySearchRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CategorySearchRequest $request): \Illuminate\Http\JsonResponse
    {
        $size = $request->size ?? 10;
        $search = $request->search ?? '';
        return response()->json(Category::pagination($size, $search));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryCreateRequest $request,CategoryService $service)
    {
        return response()->json($service->create($request->categories));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(Category::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param int $id
     * @param CategoryService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryUpdateRequest $request, int $id,CategoryService $service)
    {
        return response()->json($service->update($request,$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id,CategoryService $service)
    {
        return response()->json($service->delete($id));
    }
}
