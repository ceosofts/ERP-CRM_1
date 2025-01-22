<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\DashboardController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\HomeController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\ProfileController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\RoleController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\UserController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\PermissionController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\PermissionRoleController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\RoleUserController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\RolePermissionController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\ProfileUserController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\ProfilePermissionController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\ProfileRoleController;  //>>> เพิ่มมาใหม่
// use App\Http\Controllers\PermissionUserController; //>>> เพิ่มมาใหม่
// use App\Http\Controllers\PermissionProfileController; //>>> เพิ่มมาใหม่

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('customers', CustomerController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('orders', OrderItemController::class);
