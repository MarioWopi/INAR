<?php

use App\Http\Controllers\ClashRoyaleController;
use App\Http\Controllers\HostioController;
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
});

Route::get('/getDomainsByIp', [HostioController::class, 'getDomainsByIp']);
Route::get('/getAll', [HostioController::class, 'getAll']);
Route::get('/getByField', [HostioController::class, 'getByField']);

Route::get('/getPlayer', [ClashRoyaleController::class, 'getPlayer']);