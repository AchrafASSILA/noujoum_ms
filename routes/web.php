<?php

use Illuminate\Support\Facades\Artisan;
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
