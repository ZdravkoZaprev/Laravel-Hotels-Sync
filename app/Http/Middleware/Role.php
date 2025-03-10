<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Role
{
    public function handle($request, Closure $next, ...$roles)
    {
        try {
            // Authenticate user with JWT
            $user = JWTAuth::parseToken()->authenticate();
            
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Check if the user is an admin
            if ($user->isAdmin()) {
                return $next($request);
            }

            // Check if user has any of the required roles
            foreach ($roles as $role) {
                if ($user->hasRole($role)) {
                    return $next($request);
                }
            }

            return response()->json(['error' => 'Forbidden'], 403);

        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token Expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token Invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token Not Provided'], 401);
        }
    }
}
