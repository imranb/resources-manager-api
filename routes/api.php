<?php

use App\Http\Controllers\Api\LinksController;
use App\Http\Controllers\Api\PdfsController;
use App\Http\Controllers\Api\SnippetsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('pdfs')->name('pdf.')->group(function () {
    Route::get('/',                     [PdfsController::class, 'index'])->name('index');
    Route::post('store',                [PdfsController::class, 'store'])->name('store');
    Route::post('{pdf}/update',         [PdfsController::class, 'update'])->name('update');
    Route::delete('{pdf}/delete',       [PdfsController::class, 'destroy'])->name('destroy');
});

Route::prefix('snippets')->name('snippets.')->group(function () {
    Route::get('/',                     [SnippetsController::class, 'index'])->name('index');
    Route::post('store',                [SnippetsController::class, 'store'])->name('store');
    Route::patch('{snippet}/update',    [SnippetsController::class, 'update'])->name('update');
    Route::delete('{snippet}/delete',   [SnippetsController::class, 'destroy'])->name('destroy');
});

Route::prefix('links')->name('links.')->group(function () {
    Route::get('/',                     [LinksController::class, 'index'])->name('index');
    Route::post('store',                [LinksController::class, 'store'])->name('store');
    Route::patch('{link}/update',       [LinksController::class, 'update'])->name('update');
    Route::delete('{link}/delete',      [LinksController::class, 'destroy'])->name('destroy');
});
