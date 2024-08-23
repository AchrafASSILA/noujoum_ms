<?php

use App\Exports\ClientsExport;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Fnc\FncController;
use App\Http\Controllers\Fnc\FncEncaissementsController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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


Route::get('/impressions-clients', [ClientController::class, 'exportPdf']);
Route::get('/impressions-encaissement-recu/{id}', [FncEncaissementsController::class, 'recu']);
Route::get('/impressions-client-badge/{id}', [ClientController::class, 'badge']);
Route::get('/impressions-export-etat-services-pdf', [FncController::class, 'exportEtatServicesPdf']);
Route::get('/exports-clients', [ClientController::class, 'export']);
Route::get('/export-etat-services-excel', [FncController::class, 'exportEtats']);


Route::get('/', function () {

    return view('welcome');
})->name('application');


Route::get('/{pathMatch}', function () {
    return view('welcome');
})->where('pathMatch', '.*');
// key=wmwQcLsQljWyuBT6j4qYZeDaJcICaCa5SpG90rKsTPDMaLIwQamKPpdnK3vvjc1V

Route::get('/artisan/{cmd}', function ($cmd) {
    Artisan::call($cmd);
    return response(['cmd' => $cmd]);
});
