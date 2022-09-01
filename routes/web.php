<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\CategoriasController;
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
    return view('auth/login');
});


Route::get('/home', [LibrosController::class, 'index'])->name('home');

//desactivamos el registro y el reseteo de contraseña
Auth::routes(['register' => false, 'reset' => false]);

Route::resource('libros', LibrosController::class)->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [LibrosController::class, 'index'])->name('home');
    Route::resource('libros', LibrosController::class);
    Route::resource('categorias', CategoriasController::class);
});
