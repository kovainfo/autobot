<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TelegramUserController;
use App\Models\TelegramUser;
use App\Http\Controllers\CheckCarsController;
use App\Http\Controllers\UserController;
use App\Models\CheckCars;
use App\Http\Controllers\RegCarsController;
use App\Models\RegCars;
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

Route::get('/', function () {
    return view('auth');
})->name('auth');

Route::post('users/update', [UserController::class, 'update'])->middleware('role:admin');
Route::post('users/delete', [UserController::class, 'destroy'])->middleware('role:admin');
Route::post('users/create', [UserController::class, 'store'])->middleware('role:admin');
Route::get('users/index', [UserController::class, 'index'])->middleware('role:admin');
Route::get('users/testData', [UserController::class, 'addFiveRandomUsers'])->middleware('role:admin');
Route::get('users/getCount', [UserController::class, 'getUsersCount'])->middleware('role:admin');

Route::post('login', [AuthController::class, 'login'])->name("login");

Route::get('admin', function(){
    return view('admin');
})->name("index")->middleware('role:admin');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('UserManage', function () {
    return view('UserManage');
})->name('userManage');


Route::apiResource('reg_cars', RegCarsController::class)->middleware('role');

Route::post('reg_cars/update', [RegCarsController::class, 'update'])->middleware('role');


Route::get('/RegCars', function () {
    return view('RegCars');
})->name('RegCars')->middleware('role');
