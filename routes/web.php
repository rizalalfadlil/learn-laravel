<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\characterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/charactes',[characterController::class, 'getAll']);
Route::get('/charactes/{id}',[characterController::class, 'getOne']);
Route::post('/charactes',[characterController::class, 'store']);
Route::put('/charactes/{id}',[characterController::class, 'update']);
Route::delete('/charactes/{id}',[characterController::class, 'delete']);

Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
 
    $token = csrf_token();
    return response($token);
});
