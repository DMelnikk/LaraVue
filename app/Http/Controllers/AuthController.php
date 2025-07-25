<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function create()
    {
        return inertia('Auth/Login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

       if(!Auth::attempt($request->only('email', 'password'),true)) {
           throw ValidationException::withMessages([
               'email' => 'Authentication failed',
           ]);

       }
       $request->session()->regenerate();
       return redirect()->intended('/listing');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('listing.index');
    }
}
