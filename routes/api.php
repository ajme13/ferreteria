<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('producto', ProductoController::class); //la ruta de la api no puede ser la misma que la ruta de web

//para mapear una api primero hay que crear el product resource, despues se configura la ruta de la api y finalmente el controlador