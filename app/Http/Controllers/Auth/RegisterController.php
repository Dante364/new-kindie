<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parents;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // dd($request->all());
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            // 'confirmed_password' => 'required|same:password',
            'phone' => 'required'
        ]);

        $parent = Parents::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'phone' => $fields['phone']
        ]);

        auth()->login($parent);

        return redirect('/parent/home');
    }
}
