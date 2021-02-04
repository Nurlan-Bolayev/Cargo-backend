<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    public function login(Request $request)
    {
        $attrs = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4'
        ], [
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.'
        ]);

        if (Auth::guard('admin')->attempt($attrs)) {
            return Auth::guard('admin')->user();
        }

        throw ValidationException::withMessages([
            'email' => ['These credentials do not match our records.'],
        ]);
    }
}
