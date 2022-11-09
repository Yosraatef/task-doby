<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\FileController;
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
Route::post('user', [UserController::class, 'create']);

Route::any('upload-file', [FileController::class, 'uploadFile'])->name('api.upload.file');
