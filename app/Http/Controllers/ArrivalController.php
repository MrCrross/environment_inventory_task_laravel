<?php

namespace App\Http\Controllers;

use App\Http\Requests\Arrival\ArrivalCreateRequest;
use App\Http\Requests\Arrival\ArrivalFilterRequest;
use App\Http\Requests\Arrival\ArrivalUpdateRequest;
use App\Models\Arrival;
use App\Services\ArrivalService;
use Illuminate\Http\Request;

class ArrivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ArrivalFilterRequest $request): \Illuminate\Http\JsonResponse
    {
        $size = $request->size??10;
        return response()->json(Arrival::pagination($request,$size));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArrivalCreateRequest $request,ArrivalService $service): \Illuminate\Http\JsonResponse
    {
        return response()->json($service->create($request->arrival));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arrival  $arrival
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(Arrival::getId($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Arrival  $arrival
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArrivalUpdateRequest $request, int $id,ArrivalService $service): \Illuminate\Http\JsonResponse
    {
        return response()->json($service->update($request,$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Arrival  $arrival
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id,ArrivalService $service): \Illuminate\Http\JsonResponse
    {
        return response()->json($service->delete($id));
    }
}
