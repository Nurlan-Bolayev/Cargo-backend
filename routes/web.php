<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('api/register', UserController::class.'@register');
Route::post('api/login',UserController::class .'@login');
Route::get('api/logout', UserController::class .'@logout');


Route::post('api/admin/login', AdminController::class .'@login');
Route::post('api/admin/logout', AdminController::class .'@logout');
