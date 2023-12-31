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
Route::get('/',function(){
    return redirect()->route('companies.index');
});
Route::resource('companies', \App\Http\Controllers\CompanyController::class)->middleware('auth');
Route::resource('employees', \App\Http\Controllers\EmployeeController::class)->middleware('auth');

Route::get('/login',[\App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',[\App\Http\Controllers\LoginController::class, 'login']);
Route::post('/logout',[\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
