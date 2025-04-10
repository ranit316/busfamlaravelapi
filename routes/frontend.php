<?php

use App\Http\Controllers\setting\SettingController;
use Illuminate\Support\Facades\Route;



Route::get('site/settings', [SettingController::class, 'index']);