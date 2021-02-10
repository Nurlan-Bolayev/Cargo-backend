<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:admin')->group(function () {
    Route::get('admins/me', fn (Request $request) => $request->user());

    Route::get('/addresses', AdminController::class . '@addresses');
    Route::get('/users/{user}', AdminController::class . '@getUser');

    Route::post('/packages/{user}/package', AdminController::class . '@addPackage');
    Route::get('/packages/{package}', AdminController::class .'@getPackage');
    Route::post('/packages/{package}', AdminController::class . '@changePackageStatus');
    Route::get('/packages', AdminController::class . '@allPackages');
});
