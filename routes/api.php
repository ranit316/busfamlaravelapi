<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\setting\SettingController;
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

require __DIR__.'/frontend.php';

Route::post('admin/login', [LoginController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    
});
