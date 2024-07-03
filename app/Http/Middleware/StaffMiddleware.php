<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Staff;

class StaffMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $email = auth()->user()->email;

            // Query the Staff table instead of the User table
            $staff = Staff::where('email', $email)->first();

            if (!$staff) {
                return response([
                    'message' => 'Unauthorized Staff Member',
                    'email' => $email,
                ], 401);
            }
        }

        return $next($request);
    }
}
