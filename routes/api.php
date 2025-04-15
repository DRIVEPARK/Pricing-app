<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PricingController;
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

Route::get('/clients', [ClientController::class, 'index']);

// Trasa do dodania klienta
Route::post('/clients', [ClientController::class, 'store']);

// Trasa do dodania projektu do klienta
Route::get('/projects', [ProjectController::class, 'index']);

Route::post('/projects', [ProjectController::class, 'store']);

// Trasa do dodania wyceny do projektu przypisanego do klienta
Route::get('/pricing', [PricingController::class, 'index']);

Route::post('/pricing', [PricingController::class, 'store']);