<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RouteResource;
use App\Models\Route;
use App\Http\Requests\RouteStoreRequest;
use App\Http\Requests\RouteUpdateRequest;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::with('trips')->get();
        return RouteResource::collection($routes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RouteStoreRequest $request)
    {
        $validated = $request->validated(); 
        Route::create($validated);
        return response()->json(['status' => true], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        $route->load('trips');
        return new RouteResource($route);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RouteUpdateRequest $request)
    {
        $route = Route::findOrFail($request->id);
        $route->update($request->validated());
        return response()->json(['status' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate(['id' => 'required|exists:routes,id']);
        $route = Route::findOrFail($request->id);
        $route->delete();
        return response()->json(['status' => true], 204);
    }
}
