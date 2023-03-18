<?php

use App\Http\Controllers\ApprouveRecettteController;
use App\Http\Controllers\ApprouveDepenseController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    Auth::logout();
    return view('auth.login');
})->name('login');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'check'])->name('check');
Route::post('/register', [RegisterController::class, 'register'])->name('post.register');

/* End Login & Register*/

/* Start Recettes */

Route::middleware(['auth', 'president'])->group(function () {

    /* Start approuve Recette*/
    Route::get('/approuve/recette/show', [ApprouveRecettteController::class, 'index'])->name('approuve.recette.show');
    Route::get('/approuve/recette/{id}', [ApprouveRecettteController::class, 'approved'])->name('approuve.recette.post');
    Route::delete('/approuve/recette/delete/{id}', [ApprouveRecettteController::class, 'destroy'])->name('approuve.recette.cancel');
    /* End approuve Recette*/
    /* Start approuve Depense*/
    Route::get('/approuve/depense/show', [ApprouveDepenseController::class, 'index'])->name('approuve.depense.show');
    Route::post('/approuve/depense/{id}', [ApprouveDepenseController::class, 'approved'])->name('approuve.depense.post');
    Route::delete('/approuve/depense/delete/{id}', [ApprouveDepenseController::class, 'destroy'])->name('approuve.depense.cancel');
    /* End approuve Depense*/
});

Route::middleware(['auth', 'tresorie'])->group(function () {

    /* Start approuve */

    Route::get('/recette/add',  [RecetteController::class, 'index'])->name('recette.add');
    Route::post('/recette/add', [RecetteController::class, 'add'])->name('post.recette.add');
    Route::get('/depense/add',  [DepenseController::class, 'index'])->name('depense.add');
    Route::post('/depense/add', [DepenseController::class, 'add'])->name('post.depense.add');

    /* End approuve */
});

Route::middleware(['auth', 'secretaire'])->group(function () {

    /* Start approuve */

    Route::get('/document/add',  [DocumentController::class, 'index'])->name('document.add');
    Route::post('/document/add', [DocumentController::class, 'add'])->name('post.document.add');
    /* End approuve */
});


Route::get('/recette/edit/{id}', [RecetteController::class, 'edit'])->name('recette.edit');
Route::delete('/recette/delete/{id}', [RecetteController::class, 'destroy'])->name('recette.delete');
Route::put('/recette/update/{id}', [RecetteController::class, 'update'])->name('post.recette.edit');
Route::get('/recette/show', [RecetteController::class, 'show'])->name('recette.show');
Route::get('/recette/pdf/{path}', [RecetteController::class, 'viewPdf'])->name('viewPdf');

/* End Recettes */

/* start doc */

Route::get('/document/edit/{id}', [DocumentController::class, 'edit'])->name('document.edit');
Route::delete('/document/delete/{id}', [DocumentController::class, 'destroy'])->name('document.delete');
Route::put('/document/update/{id}', [DocumentController::class, 'update'])->name('post.document.edit');
Route::get('/document/show', [DocumentController::class, 'show'])->name('document.show');
Route::get('/document/pdf/{path}', [DocumentController::class, 'viewPdf'])->name('viewPdf');

/* end doc */

/* Start Depnses */
Route::get('/depense/edit/{id}',     [DepenseController::class, 'edit'])->name('depense.edit');
Route::delete('depense/delete/{id}', [DepenseController::class, 'destroy'])->name('depense.delete');
Route::put('/depense/update/{id}', [DepenseController::class, 'update'])->name('post.depense.edit');
Route::get('/depense/show', [DepenseController::class, 'show'])->name('depense.show');
Route::get('/depense/pdf/{path}', [DepenseController::class, 'viewPdf'])->name('viewPdf');

/* End Depnses */

Route::get('/home', [ChartsController::class, 'chart'])->name('charts');
