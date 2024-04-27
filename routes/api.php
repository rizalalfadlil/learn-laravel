<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\characterController;

Route::get('/charactes',[characterController::class, 'getAll']);
