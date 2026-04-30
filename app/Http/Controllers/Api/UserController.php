<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return response()->json(['status' => true], 201);
    }

    public function update(UserUpdateRequest $request)
    {
        $user = User::findOrFail($request->id);
        $user->update($request->validated());
        return response()->json(['status' => true], 200);
    }

    public function destroy(Request $request)
    {
        $request->validate(['id' => 'required|exists:users,id']);
        $user = User::findOrFail($request->id);
        $user->delete();
        return response()->json(['status' => true], 204);
    }

    public function changePassword(PasswordChangeRequest $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['status' => true], 200);
    }
}
