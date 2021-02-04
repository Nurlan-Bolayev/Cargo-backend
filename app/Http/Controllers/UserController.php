<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request){
        $attrs = $request->validate([
            'name' => 'required|min:4',
           'email' => 'required|email|unique:users',
           'password' => 'required|min:4'
        ],[
            'email.required' => 'The email field is required.',
            'email.unique' => 'This email is already taken.',
            'password.required' => 'The password field is required.'
        ]);

        $user = User::query()->forceCreate([
            'name' => $attrs['name'],
            'email' => $attrs['email'],
            'password' => \Hash::make($attrs['password'])
        ]);

        \Auth::login($user);

        return $user;
    }

    public function login(Request $request){
        $attrs = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:4'
        ],[
            'email.required' => 'The email field is required.',
            'email.exists' => 'The selected email is invalid.',
            'password.required' => 'The password field is required.'
        ]);

        if(\Auth::attempt($attrs)){
            return \Auth::user();
        }

        throw ValidationException::withMessages([
           'message' => ['These credentials do not match our records.']
        ]);
    }
}
