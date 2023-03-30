<?php

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


Route::prefix('admin')->group(function () {

    Route::get('/login', \App\Http\Livewire\Admin\Login::class)->name('admin.login');
    Route::any('/logout', \App\Http\Livewire\Admin\Login::class)->name('admin.logout');


    Route::middleware(['auth'])->group(function () {

        Route::get('/', \App\Http\Livewire\Admin\Home::class)->name('admin.home');

        Route::get('/settings', \App\Http\Livewire\Admin\Settings::class)->middleware('permission:settings show')->name('admin.settings');

        Route::prefix('roles')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Roles\Roles::class)->middleware('permission:roles show')->name('admin.roles');
        });

        Route::prefix('prices')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Prices\Prices::class)->middleware('permission:prices show')->name('admin.prices');
        });

        Route::prefix('transactions')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Transactions\Transactions::class)->middleware('permission:transactions show')->name('admin.transactions');
        });

        Route::prefix('vouchers')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Vouchers\Vouchers::class)->middleware('permission:vouchers show')->name('admin.vouchers');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Users\Users::class)->middleware('permission:users show')->name('admin.users');
            Route::get('/{id}', \App\Http\Livewire\Admin\Users\UsersShow::class)->middleware(['permission:users show'])->name('admin.users.show');
        });

        Route::prefix('accounts')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Accounts\Accounts::class)->middleware('permission:accounts show')->name('admin.accounts');
            Route::get('/{id}', \App\Http\Livewire\Admin\Accounts\AccountsShow::class)->middleware(['permission:accounts show'])->name('admin.accounts.show');
        });

    });
});


