<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) 
        {
            return redirect()->route('admin.home')->with('success', 'Login successful');
        }

        if(Auth::guard('staff')->attempt(['email' => $email, 'password' => $password])) 
        {
            return redirect()->route('staff.home')->with('success', 'Login successful');
        }

        if(Auth::guard('parent')->attempt(['email' => $email, 'password' => $password])) 
        {
            return redirect()->route('parent.home')->with('success', 'Login successful');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}