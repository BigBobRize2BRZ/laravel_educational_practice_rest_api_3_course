<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['status'] = $data['status'] ?? 'user';
        return User::create($data);
    }

    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => 'Incorrect email or password'
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'token' => $user->createToken("Token:{$user->name}")->plainTextToken,
            'name' => $user->name
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        $token = $user->currentAccessToken();
        if ($token) {
            $token->delete();
        }

        return response()->json(['message' => 'Logged out successfully']);
    }
}
