<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneratorController;
use Faker\Generator;


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
    return view('welcome');
});

Route::post('/v1/license/validate', [GeneratorController::class, 'sendResponse'])->name('sendResponse');
Route::post('/v1/license/invalidate/details', [GeneratorController::class, 'getResponse'])->name('getResponse');
Route::post('/v1/license/ghost/details', [GeneratorController::class, 'ghostResponse'])->name('ghostResponse');
Route::post('/v1/license/integrity/details', [GeneratorController::class, 'integrityResponse'])->name('integritytResponse');
