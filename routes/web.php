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

Route::post('/auth', [AuthController::class,'auth'])->name('auth');


Route::get('/', function () {
    return view('login');
})->name('login');

Route::middleware(['isLogin', 'CekRole:admin,employe'])->group(function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});



Route::middleware(['isLogin', 'CekRole:employe'])->group(function(){
    Route::get('/employe', [AuthController::class, 'loginEmploye'])->name('employe.employeDash');
    Route::get('/employeProduct', [ProductController::class, 'employeProduct'])->name('employeProduct');

    Route::get('/sale', [ProductController::class, 'sale'])->name('sale');
    Route::get('/saleCreate', [ProductController::class, 'saleCreate'])->name('saleCreate');
    Route::post('/chekoutStore', [ProductController::class, 'storePenjualan'])->name('chekoutStore');
  

    Route::delete('/deleteCustomer/{id}', [ProductController::class, 'saleDelete' ])->name('saleDelete');
});

Route::get('/viewCetak/{id_pesanan}', [ProductController::class, 'strukView'])->name('viewCetak');
Route::get('/export/excel', [ProductController::class,'createExcel'])->name('export.excel');
Route::get('/export/pdf/{id}', [ProductController::class, 'cetakpenjualan'])->name('export.pdf');
// Route::get('/DetailPenjualan/{id}', [ProductController::class, 'detailPenjualan'])->name('detailPenjualan');



Route::middleware(['isLogin', 'CekRole:admin'])->group(function () {
    Route::get('/index', [ProductController::class, 'index'])->name('index');
    Route::get('/product', [ProductController::class, 'create'])->name('create');
    Route::post('/product', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProductController::class,'edit'])->name('edit');
    Route::patch('/update/{id}', [ProductController::class, 'update'])->name('update');
    Route::get('/editStok/{id}', [ProductController::class,'editStok'])->name('editStok');
    Route::patch('/updateStok/{id}', [ProductController::class, 'updateStok'])->name('updateStok');
    Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');

    Route::get('/saleAdmin', [ProductController::class, 'saleAdmin'])->name('saleAdmin');

    Route::get('/user', [AuthController::class, 'register'])->name('user');
    Route::post('/regitser', [AuthController::class, 'createuser'])->name('createUser');

    Route::get('/editUser/{id}', [AuthController::class, 'editUser'])->name('editUser');
    Route::post('/updateUser/{id}', [AuthController::class, 'updateUser'])->name('updateUser');

    Route::delete('/deleteUser/{id}', [AuthController::class, 'deleteUser'])->name('deleteUser');

    // Route::get('/export/excel', [ProductController::class,'createExcel'])->name('export.excel');




});








