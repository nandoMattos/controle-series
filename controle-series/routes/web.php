<?php

use App\Http\Controllers\EntrarController;
use App\Http\Controllers\EpisodiosController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/entrar', [EntrarController::class, 'index']);
Route::post('/entrar', [EntrarController::class, 'entrar']);

Route::get('/registrar', [RegistroController::class, 'create']);
Route::post('/registrar', [RegistroController::class, 'store']);

Route::get('/', [SeriesController::class, 'index']);
Route::get('/series', [SeriesController::class, 'index']);
Route::get('/series/criar', [SeriesController::class, 'create'])->middleware('auth');
Route::post('/series/criar', [SeriesController::class, 'store'])->middleware('auth');
Route::delete('/series/{id}', [SeriesController::class, 'destroy'])->middleware('auth');
Route::post('/series/{id}/editaNome', [SeriesController::class, 'editaNome'])->middleware('auth');

Route::get('/series/{serieId}/temporadas', [TemporadasController::class, 'index']);

Route::get('/temporadas/{temporada}/episodios', [EpisodiosController::class, 'index']);
Route::post('/temporadas/{temporada}/episodios/assistir', [EpisodiosController::class, 'assistir'])->middleware('auth');;

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/entrar');
});

require __DIR__.'/auth.php';
