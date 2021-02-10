<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OverseasAddress;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
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

    public function logout()
    {
        Auth::guard('admin')->logout();
    }

    public function addPackage(Request $request, User $user)
    {
        $attrs = $request->validate([
            'start_point_id' => 'required|integer|exists:overseas_addresses,id',
            'weight' => 'required|integer',
            'shipping_price' => 'required|integer',
            'dimensions' => 'nullable|string',
            'guarantee' => 'required|boolean',
            'status' => 'required|string'
        ]);

        return Package::query()->forceCreate(array_merge($attrs, [
            'owner_id' => $user->id
        ]));

    }

    public function getPackage(Package $package){
        return $package;
    }

    public function changePackageStatus(Request $request, Package $package)
    {
        $attrs = $request->validate([
            'status' => 'required|string',
        ]);

        $package->update([
            'status' => $attrs['status'],
        ]);

        $package->save();

        return $package;

    }

    public function addresses()
    {
        return OverseasAddress::all();
    }

    public function getUser(User $user)
    {
        return $user;
    }

    public function allPackages()
    {
        return Package::with('overseasAddresses','owner')->get();
    }
}
