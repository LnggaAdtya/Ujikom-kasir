<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

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

Route::get('/landing', function () {
    return view('admin.landing');
})->name('landing');

Route::get('/user', function () {
    return view('admin.user');
})->name('user');
Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/auth', [AuthController::class,'auth'])->name('auth');

Route::get('/index', [ProductController::class, 'index'])->name('index');
Route::get('/product', [ProductController::class, 'create'])->name('create');
Route::post('/product', [ProductController::class, 'store'])->name('store');

Route::get('/edit/{id}', [ProductController::class,'edit'])->name('edit');
Route::patch('/update/{id}', [ProductController::class, 'update'])->name('update');

Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
