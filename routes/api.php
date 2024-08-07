<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Edt\SeanceController;
use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Service\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// logout route

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
});


// login route
Route::post('login', [AuthController::class, 'login'])->name('login');



// other routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('sections', SectionController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('seances', SeanceController::class);
    Route::get('archived-clients', [ClientController::class, 'archivedClients']);
    Route::post('/unarchived-client/{id}', [ClientController::class, 'unarchived']);
    Route::delete('/delete-trached/{id}', [ClientController::class, 'deleteTrached']);
});
