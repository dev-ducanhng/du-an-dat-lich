<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
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
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin']);

Route::prefix('service')->name('service.')->group(function () {
    Route::get('/', [ServiceController::class, 'getService'])->name('index');
    Route::get('/add', [ServiceController::class, 'addForm'])->name('add');
    Route::post('/add', [ServiceController::class, 'saveAdd']);
    Route::get('/edit/{id}', [ServiceController::class, 'editForm'])->name('edit');
    Route::post('/edit/{id}', [ServiceController::class, 'saveEdit']);
});

Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('/', [StaffController::class, 'getService'])->name('index');
    Route::get('/add', [StaffController::class, 'addForm'])->name('add');
    Route::post('/add', [StaffController::class, 'saveAdd']);
    Route::get('/edit/{id}', [StaffController::class, 'editForm'])->name('edit');
    Route::post('/edit/{id}', [StaffController::class, 'saveEdit']);
    Route::get('/remove/{id}', [StaffController::class, 'remove'])->name('remove');
});
