<?php

use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
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

Route::get('/', function () {
    return view('welcome');
})->name('main.dashboard');
