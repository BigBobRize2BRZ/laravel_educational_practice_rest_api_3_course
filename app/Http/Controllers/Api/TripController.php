<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TripStoreRequest;
use App\Http\Requests\TripUpdateRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TripResource::collection(Trip::with(['bus', 'route'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TripStoreRequest $request)
    {
        Trip::create($request->validated());
        return response()->json(['status' => true], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        $trip->load(['bus', 'route']);
        return new TripResource($trip);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TripUpdateRequest $request)
    {
        $trip = Trip::findOrFail($request->id);
        $trip->update($request->validated());
        return response()->json(['status' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate(['id' => 'required|exists:trips,id']);
        $trip = Trip::findOrFail($request->id);
        $trip->delete();
        return response()->json(['status' => true], 204);
    }
}
