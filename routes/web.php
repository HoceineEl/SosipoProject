<?php

use App\Http\Controllers\ApprouveController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\RegisterController;
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

/* Start Login & Register */

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::get('/home', [FunctionController::class, 'index'])->name('home');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'check'])->name('check');
Route::post('/register', [RegisterController::class, 'register'])->name('post.register');

/* End Login & Register*/

/* Start Recettes */

Route::middleware(['auth','president'])->group(function(){

/* Start approuve */
    Route::get('/approuve/show', [ApprouveController::class, 'index'])->name('approuve.show');
    Route::get('/approuve/{id}', [ApprouveController::class, 'approved'])->name('approuve.post');
    Route::delete('/approuve/delete/{id}', [ApprouveController::class, 'destroy'])->name('approuve.cancel');
/* End approuve */



});

Route::middleware(['auth','tresorie'])->group(function(){

/* Start approuve */

Route::get('/recette/add', [RecetteController::class, 'index'])->name('recette.add')->middleware('president');
Route::post('/recette/add', [RecetteController::class, 'add'])->name('post.recette.add');
Route::get('/recette/edit/{id}', [RecetteController::class, 'edit'])->name('recette.edit');
Route::delete('/recette/delete/{id}', [RecetteController::class, 'destroy'])->name('recette.delete');
Route::put('/recette/update/{id}', [RecetteController::class, 'update'])->name('post.recette.edit');

/* End approuve */



});

Route::get('/recette/show', [RecetteController::class, 'show'])->name('recette.show');
Route::get('/recette/pdf/{path}', [RecetteController::class, 'viewPdf'])->name('viewPdf');


/* End Recettes */






