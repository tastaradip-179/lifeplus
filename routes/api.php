<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login_view')->name('login');
    Route::get('register', 'register_view');
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::get('/home', 'welcome');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('user-profile', 'userProfile');
    Route::get('user-profile-view', 'userProfileView');
});

Route::resource('bank_accounts', BankAccountController::class);

Route::resource('transactions', TransactionController::class);
Route::get('transactions/deposit/{id}', [TransactionController::class, 'deposit_view']);
Route::get('transactions/withdraw/{id}', [TransactionController::class, 'withdraw_view']);
