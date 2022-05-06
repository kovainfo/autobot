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

Route::get('welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('user_editing', function () {
    return view('user_editing');
})->name('user_editing');

Route::post('users/update', [UserController::class, 'update']);
Route::post('users/delete', [UserController::class, 'destroy']);
Route::post('users/create', [UserController::class, 'store']);
Route::get('users/index', [UserController::class, 'index']);
Route::get('users/testData', [UserController::class, 'addFiveRandomUsers']);
Route::get('users/getCount', [UserController::class, 'getUsersCount']);
Route::get('reg_cars/getCount', [RegCarsController::class, 'getCarsCount']);

Route::get('usersList', function() {
    return view("usersList");
})->name("usersList");

Route::get('UserReportFilter', function() {
    return view("UserReportFilter");
});

Route::post('login', [AuthController::class, 'login'])->name("login");

Route::get('admin', function(){
    return view('admin');
})->name("index")->middleware('role:admin');

Route::get('security', function(){
    return view('security');
})->name("security");

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('UserManage', function () {
    return view('UserManage');
})->name('userManage');

Route::get('otchet', function () {
    return view('otchet');
})->name('otchet');

Route::get('otchetAuto', function () {
    return view('otchetAuto');
})->name('otchetAuto');

Route::get('NewRegCar', function () {
    return view('NewRegCar');
})->name('newregcar');


Route::apiResource('reg_cars', RegCarsController::class)->middleware('role');

Route::post('reg_cars/update', [RegCarsController::class, 'update'])->middleware('role');


Route::get('/RegCars', function () {
    return view('RegCars');
})->name('RegCars')->middleware('role');