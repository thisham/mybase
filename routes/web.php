<?php

use App\Http\Controllers\CreateIncomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\UpdateIncomeController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::get('/sign-in', [SignInController::class, 'render'])
    ->name('auth.sign-in');
Route::post('sign-in', [SignInController::class, 'handle'])
    ->name('auth.sign-in');

Route::get('/sign-up', [SignUpController::class, 'render'])
    ->name('auth.sign-up');
Route::post('sign-up', [SignUpController::class, 'handle'])
    ->name('auth.sign-up');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'render'])
        ->name('main.dashboard');

    Route::get('/financial/incomes', [IncomeController::class, 'render'])
        ->name('financial.incomes');

    Route::get('/financial/incomes/create', [CreateIncomeController::class, 'render'])
        ->name('financial.create-income');
    Route::post('/financial/incomes/create', [CreateIncomeController::class, 'handle'])
        ->name('financial.create-income');

    Route::get('/financial/incomes/{id}/update', [UpdateIncomeController::class, 'render'])
        ->name('financial.update-income');
    Route::post('/financial/incomes/{id}/update', [UpdateIncomeController::class, 'handle'])
        ->name('financial.update-income');

    Route::get('/sign-out', function () {
        Auth::logout();
        return redirect()->route('auth.sign-in');
    })->name('auth.sign-out');
});