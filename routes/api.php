<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EkstrakulikulerController;
use App\Http\Controllers\EkstrakulikulerSiswaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});
Route::prefix('siswa')->group(function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::post('/', [StudentController::class, 'store']);
    Route::put('/{id}', [StudentController::class, 'update']);
    Route::delete('/{id}', [StudentController::class, 'destroy']);
});
Route::prefix('ekskul')->group(function () {
    Route::get('/', [EkstrakulikulerController::class, 'index']);
    Route::post('/', [EkstrakulikulerController::class, 'store']);
    Route::put('/{id}', [EkstrakulikulerController::class, 'update']);
    Route::delete('/{id}', [EkstrakulikulerController::class, 'destroy']);
});
Route::prefix('ekskul-siswa')->group(function () {
    Route::get('/', [EkstrakulikulerSiswaController::class, 'index']);
    Route::post('/', [EkstrakulikulerSiswaController::class, 'store']);
    Route::put('/{id}', [EkstrakulikulerSiswaController::class, 'update']);
    Route::delete('/{id}', [EkstrakulikulerSiswaController::class, 'destroy']);
});
