<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusStoreRequest;
use App\Http\Requests\BusUpdateRequest;
use App\Http\Resources\BusResource;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BusResource::collection(Bus::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BusStoreRequest $request)
    {
        Bus::create($request->validated());
        return response()->json(['status' => true], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bus $bus)
    {
        return new BusResource($bus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BusUpdateRequest $request)
    {
        $bus = Bus::findOrFail($request->id);
        $bus->update($request->validated());
        return response()->json(['status' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate(['id' => 'required|exists:buses,id']);
        $bus = Bus::findOrFail($request->id);
        $bus->delete();
        return response()->json(['status' => true], 204);
    }
}
