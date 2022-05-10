<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportPokemonController;

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

// Route::get('/', function () {
//     return view('welcome');
// // });

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/token/create', [DashboardController::class, 'showTokenForm'])->name('token.showForm');
    Route::get('/addpokemon', [DashboardController::class, 'addPokemon'])->name('addpokemon');
    Route::post('/token/create', [DashboardController::class, 'createToken'])->name('token.create');
    Route::post('/token/delete/{token}', [DashboardController::class, 'deleteToken'])->name('token.delete');
});

Route::post('import', [ImportPokemonController::class, 'index'])->name('import');

require __DIR__.'/auth.php';
