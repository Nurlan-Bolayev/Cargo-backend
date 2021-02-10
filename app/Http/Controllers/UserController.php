<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\TrustedPeople;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $attrs = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'surname' => 'required',
            'password' => 'required|min:4',
            'birth_date' => 'required',
            'address' => 'required',
            'delivery_address' => 'required',
            'IIN' => 'required',
            'ID_card_number' => 'required',
            'phone_number' => 'required',
            'gender' => 'required'
        ]);
        $customer_code = rand(100000, 999999);
        $birth_date = json_encode([
            'day' => $request->birth_date['day'],
            'month' => $request->birth_date['month'],
            'year' => $request->birth_date['year']
        ]);
        $phone_number = json_encode([
            'prefix' => $request->phone_number['prefix'],
            'number' => $request->phone_number['number']
        ]);

        $password = Hash::make($attrs['password']);
        /** @var User $user */
        $body = [
            'password' => $password,
            'customer_code' => $customer_code,
            'birth_date' => $birth_date,
            'phone_number' => $phone_number
        ];

        $user = User::query()->forceCreate(array_merge($attrs, $body));
        \Auth::login($user, true);
        return $user;
    }

    public function login(Request $request)
    {
        $attrs = $request->validate([
            'email' => 'required',
            'password' => 'required|string|min:4',
        ]);

        if (\Auth::attempt($attrs, $request->remember_me)) {
            return \Auth::user();
        }

        throw ValidationException::withMessages([
            'message' => ['These credentials do not match our records.']
        ]);
    }

    public function logout(Request $request)
    {
        \Auth::logout();
    }

    public function addDeclaration(Request $request)
    {
        $attrs = $request->validate([
            'store' => 'required|string',
            'order_date' => 'required|date',
            'product_type' => 'required',
            'tracking_code' => 'required',
            'order_number' => 'required',
            'price' => 'required',
            'product_description' => 'required',
            'invoice' => 'required|file',
        ]);
        $invoice_path = $request->file('invoice')->store('invoices', 'public');

        $data = [
            'invoice' => $invoice_path,
            'owner_id' => $request->user()->id,
        ];

        return Package::query()->forceCreate(array_merge($attrs, $data));
    }

    public function addAttorneyLetter(Request $request){
        $attrs = $request->validate([
           'name' => 'required|string',
           'surname' => 'required|string',
           'days' => 'required'
        ]);

        $body = [
            'user_id' => $request->user()->id,
            'name' => $attrs['name'],
            'surname' => $attrs['surname'],
            'date' => $attrs['days']
        ];

        return TrustedPeople::query()->forceCreate($body);

    }
}
