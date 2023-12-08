<?php

use App\Http\Controllers\DataTableController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Admin Routes for Users, Products, Roles, and Permissions
Route::middleware("can:role,'admin'")->group(function () {

    // Users
    Route::resource('users', UserController::class)->names('admin.users')->except(['show']);

    // Products
    Route::resource('products', ProductController::class)->names('admin.products')->except(['show']);

    // Roles
    Route::resource('roles', RoleController::class)->names('admin.roles')->except(['show']);

    // Permissions
    Route::resource('permissions', PermissionController::class)->names('admin.permissions')->except(['show']);

});

// Employee Routes for Products with specific permissions
Route::middleware("can:role,'admin','employee'")->group(function () {

    // Products
    Route::resource('products', ProductController::class)->names('admin.products')->except(['show'])
        ->middleware("can:permission,'show product|create product|update product|delete product'");

});

// DataTable Routes for Users and Products
Route::prefix('datatable')->group(function () {

    // Users DataTable
    Route::get('users', [DataTableController::class, 'users'])
        ->name('datatable.users')
        ->middleware("can:permission,'view user'");

    // Products DataTable
    Route::get('products', [DataTableController::class, 'products'])
        ->name('datatable.products')
        ->middleware("can:permission,'show product'");

});
