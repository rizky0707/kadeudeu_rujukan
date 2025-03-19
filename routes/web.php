<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RujukanController;
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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*------------------------------------------

--------------------------------------------

All Normal Users Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:user'])->group(function () {

  

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user/rujukan', [RujukanController::class, 'indexUser'])->name('rujukan.indexUser');
    Route::get('/rujukan/editUser/{id}', [RujukanController::class, 'editUser'])->name('rujukan.editUser');
    Route::put('/rujukan/updateUser/{id}', [RujukanController::class, 'updateUser'])->name('rujukan.updateUser');
    Route::post('/rujukan/{id}/approve', [RujukanController::class, 'approve'])->name('rujukan.approve');
});

  

/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::resource('admin/rujukan', RujukanController::class);

});

  

/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:manager'])->group(function () {

  

    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');

});
