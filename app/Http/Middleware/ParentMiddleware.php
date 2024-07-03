<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Parents;

class ParentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $email = auth()->user()->email;

            // Query the Parent table
            $parent = Parents::where('email', $email)->first();

            if (!$parent) {
                return response([
                    'message' => 'Unauthorized Parent',
                    'email' => $email,
                ], 401);
            }
        }

        return $next($request);
    }
}
