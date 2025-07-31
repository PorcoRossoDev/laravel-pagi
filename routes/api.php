<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PermissionStructureController;
use Illuminate\Routing\RouteGroup;

Route::prefix('v1')->group(function () {

    Route::prefix('module')->group(function () {
        Route::get('/', [PermissionStructureController::class, 'index']);
        Route::post('/store', [PermissionStructureController::class, 'store']);
    });

    Route::post('/login', [AuthController::class, 'login']);

});