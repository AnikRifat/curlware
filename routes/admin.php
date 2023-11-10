<?php

use App\Http\Controllers\DataTableController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware("can:role,'admin'")->group(function () {

    //user
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('delete/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Products
    Route::get('products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::get('delete/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');


    // Roles
    Route::get('roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::get('delete/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    // Permissions
    Route::get('permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('permissions', [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::get('delete/permissions/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');

});

Route::middleware("can:role,'admin','employee'")->group(function () {


    // Products
    Route::get('products', [ProductController::class, 'index'])->name('admin.products.index')->middleware("can:permission,'show product'");
    Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create')->middleware("can:permission,'create  product'");
    Route::post('products', [ProductController::class, 'store'])->name('admin.products.store')->middleware("can:permission,'create  product'");
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit')->middleware("can:permission,'update product'");
    Route::put('products/{product}', [ProductController::class, 'update'])->name('admin.products.update')->middleware("can:permission,'update product'");
    Route::get('delete/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy')->middleware("can:permission,'delete product'");




});


Route::prefix('datatable')->group(function () {

    Route::get('users', [DataTableController::class, 'users'])->name('datatable.users')->middleware("can:permission,'view user'");
    Route::get('products', [DataTableController::class, 'products'])->name('datatable.products')->middleware("can:permission,'show product'");


});


