<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BudgetCreatorController;
use App\Http\Controllers\BudgetUpdaterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeCreatorController;
use App\Http\Controllers\IncomeUpdaterController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanCreatorController;
use App\Http\Controllers\LoanUpdaterController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
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
    Route::get('/financial/incomes/{id}/delete', [IncomeController::class, 'destroy'])
        ->name('financial.delete-income');

    Route::get('/financial/incomes/create', [IncomeCreatorController::class, 'render'])
        ->name('financial.create-income');
    Route::post('/financial/incomes/create', [IncomeCreatorController::class, 'handle'])
        ->name('financial.create-income');

    Route::get('/financial/incomes/{id}/update', [IncomeUpdaterController::class, 'render'])
        ->name('financial.update-income');
    Route::post('/financial/incomes/{id}/update', [IncomeUpdaterController::class, 'handle'])
        ->name('financial.update-income');

    Route::prefix('/financial/budgets')->group(function () {
        Route::get('/', [BudgetController::class, 'render'])
            ->name('financial.budgets');
        Route::get('/{id}/delete', [BudgetController::class, 'destroy'])
            ->name('financial.delete-budget');

        Route::get('/create', [BudgetCreatorController::class, 'render'])
            ->name('financial.create-budget');
        Route::post('/create', [BudgetCreatorController::class, 'handle'])
            ->name('financial.create-budget');

        Route::get('/{id}/update', [BudgetUpdaterController::class, 'render'])
            ->name('financial.update-budget');
        Route::post('/{id}/update', [BudgetUpdaterController::class, 'handle'])
            ->name('financial.update-budget');
    });

    Route::get('/financial/loans', [LoanController::class, 'render'])
        ->name('financial.loans');
    Route::get('/financial/loans/{id}/delete', [LoanController::class, 'destroy'])
        ->name('financial.delete-loan');

    Route::get('/financial/loans/create', [LoanCreatorController::class, 'render'])
        ->name('financial.create-loan');
    Route::post('/financial/loans/create', [LoanCreatorController::class, 'handle'])
        ->name('financial.create-loan');

    Route::get('/financial/loans/{id}/update', [LoanUpdaterController::class, 'render'])
        ->name('financial.update-loan');
    Route::post('/financial/loans/{id}/update', [LoanUpdaterController::class, 'handle'])
        ->name('financial.update-loan');

    Route::get('/sign-out', function () {
        Auth::logout();
        return redirect()->route('auth.sign-in');
    })->name('auth.sign-out');
});
