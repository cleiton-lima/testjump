<?php

use App\Http\Controllers\API\v1\ServiceOrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'API\v1'], function () {
    Route::get('/service-orders', [ServiceOrderController::class, 'index']);
    Route::post('/service-orders', [ServiceOrderController::class, 'store']);
});
