<?php

namespace App\Http\Middleware\CustomMiddlewares;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class CheckBearerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'You are not an authenticated user!'], 403);
        }

        $accessToken = PersonalAccessToken::findToken($token);
        if (!$accessToken || !$accessToken->tokenable) {
            return response()->json(['message' => 'You are not an authenticated user!'], 403);
        }

        $user = $accessToken->tokenable;
        auth()->setUser($user);
        $request->setUserResolver(fn() => $user);

        return $next($request);
    }
}
