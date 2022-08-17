<?php

namespace App\Http\Controllers;

use App\Http\Requests\Equipment\EquipmentCreateRequest;
use App\Http\Requests\Equipment\EquipmentFilterRequest;
use App\Http\Requests\Equipment\EquipmentUpdateRequest;
use App\Models\Equipment;
use App\Services\EquipmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param EquipmentFilterRequest $request
     * @return JsonResponse
     */
    public function index(EquipmentFilterRequest $request): JsonResponse
    {
        $size = $request->size ?? 10;
        return response()->json(Equipment::pagination($request,$size));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EquipmentCreateRequest $request
     * @param EquipmentService $service
     * @return JsonResponse
     */
    public function store(EquipmentCreateRequest $request,EquipmentService $service): JsonResponse
    {
        return response()->json($service->create($request->equipments));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(Equipment::with('category')->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EquipmentUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(EquipmentUpdateRequest $request, int $id,EquipmentService $service): JsonResponse
    {
        return response()->json($service->update($request,$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id,EquipmentService $service)
    {
        return response()->json($service->delete($id));
    }
}
