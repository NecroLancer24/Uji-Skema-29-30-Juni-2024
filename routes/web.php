<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TableController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login/goto', [AuthController::class, 'login'])->name('Login');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    //* Home
    Route::get('/', [TableController::class, 'index'])->name('home');
    //* Add user
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register/store', [AuthController::class, 'register'])->name('registerStore');
    //? Update user
    Route::get('/home/update/{id}', [TableController::class, 'updateView'])->name('updateView');
    Route::post('/home/update/{id}/store', [TableController::class, 'update'])->name('update');
    //! Delete
    Route::delete('/home/delete/{id}', [TableController::class, 'destroy'])->name('delete');
});