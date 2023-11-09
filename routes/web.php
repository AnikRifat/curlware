<?php

use App\Http\Controllers\DataTableController;
use App\Http\Controllers\PermissionController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('admin')->group(function () {

    //user
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');


    // ... Your other routes
    Route::get('roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    // Permissions
    Route::get('permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('permissions', [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');
});


Route::prefix('datatable')->group(function () {

    Route::get('users', [DataTableController::class, 'users'])->name('datatable.users');


});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
