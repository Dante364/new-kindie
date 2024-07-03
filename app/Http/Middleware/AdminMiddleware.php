<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Admin; 

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $email = auth()->user()->email;

            // Query the Admin table
            $admin = Admin::where('email', $email)->first();

            if (!$admin) {
                return response([
                    'message' => 'Unauthorized Admin',
                    'email' => $email,
                ], 401);
            }
        }

        return $next($request);
    }
}
