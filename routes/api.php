<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\DataKandangController;
use App\Http\Controllers\RekapDataController;
use App\Http\Controllers\AuthController;

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


Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function() {
    Route::post('/kandang', [KandangController::class, 'store']);
    Route::get('/kandang', [KandangController::class, 'index']);
    Route::put('/kandang/{id}', [KandangController::class, 'update']);
    Route::delete('/kandang/{id}', [KandangController::class, 'delete']);

    Route::post('/panen', [PanenController::class, 'store']);
    Route::get('/panen', [PanenController::class, 'index']);
    Route::put('/panen/{id}', [PanenController::class, 'update']);
    Route::delete('/panen/{id}', [PanenController::class, 'delete']);

    Route::get('/sensor-amoniak', [SensorController::class, 'indexAmonia']);
    Route::get('/sensor-suhu', [SensorController::class, 'indexSuhuKelembapan']);
    Route::post('/sensor-amoniak', [SensorController::class, 'storeAmoniak']);
    Route::post('/sensor-suhu', [SensorController::class, 'storeSuhuKelembapan']);

    Route::post('/data-kandang', [DataKandangController::class, 'store'])   ;
    Route::get('/data-kandang', [DataKandangController::class, 'index']);
    Route::put('/data-kandang/{idKandang}/{idKematian}', [DataKandangController::class, 'update']);
    Route::delete('/data-kandang/{idKematian}/{idKandang}', [DataKandangController::class, 'delete']);

    Route::post('/rekap-data', [RekapDataController::class, 'store']);
    Route::get('/rekap-data', [RekapDataController::class, 'index']);
    Route::put('/rekap-data/{id}', [RekapDataController::class, 'update']);
    Route::delete('/rekap-data/{id}', [RekapDataController::class, 'delete']);
    
    Route::post('/register', [AuthController::class, 'register']);
});
