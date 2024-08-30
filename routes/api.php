<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Config\ConfigController;
use App\Http\Controllers\Edt\SeanceController;
use App\Http\Controllers\Email\EmailController;
use App\Http\Controllers\Fnc\FncController;
use App\Http\Controllers\Fnc\FncEncaissementInscriptionController;
use App\Http\Controllers\Fnc\FncEncaissementsController;
use App\Http\Controllers\HandicapCause\HandicapCauseController;
use App\Http\Controllers\Modules\ModuleController;
use App\Http\Controllers\Region\RegionController;
use App\Http\Controllers\Role\RoleRoleController;
use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\Statistic\StatisticController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Ville\VilleController;
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
    Route::resource('modules', ModuleController::class);
    Route::resource('encaissements', FncEncaissementsController::class);
    Route::resource('encaissement-inscription', FncEncaissementInscriptionController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('villes', VilleController::class);
    Route::resource('handicapcauses', HandicapCauseController::class);
    Route::get('encaissements-inscription/{id}', [FncEncaissementInscriptionController::class, 'getEncaissements']);
    Route::get('archived-clients', [ClientController::class, 'archivedClients']);
    Route::post('/unarchived-client/{id}', [ClientController::class, 'unarchived']);
    Route::delete('/delete-trached/{id}', [ClientController::class, 'deleteTrached']);
    Route::delete('/canceld-paiement/{id}', [FncEncaissementsController::class, 'canceldPaiement']);
    Route::get('roles', [RoleRoleController::class, 'index']);
    Route::get('users', [UserController::class, 'index']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::put('update-password/{id}', [UserController::class, 'updatePassword']);
    Route::delete('users/{id}', [UserController::class, 'delete']);
    Route::get('/statistics/etats', [StatisticController::class, 'etats']);
    Route::get('/reductions', [ServiceController::class, 'reductions']);
    Route::get('/fnc/etat-financier-global-per-services', [FncController::class, 'etat_financier_global_per_services']);
    Route::get('/fnc/get-etat-journalier', [FncController::class, 'etat_journalier']);
    Route::post('/emails/send-etat-journalier', [EmailController::class, 'sendEtatJournalierToFounders']);
});
Route::resource('config', ConfigController::class);
