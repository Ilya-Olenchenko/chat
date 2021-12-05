<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[ChatController::class,'index']);
Route::put('/',[ChatController::class,'add']);

Route::get('/message',[ChatController::class,'get']);

Route::get('/reg', [AutController::class,'reg_index']);
Route::post('/reg', [AutController::class,'save']);

Route::get('/login', [AutController::class,'login_index']);
Route::post('/login', [AutController::class,'login']);

Route::get('/logout', [AutController::class,'logout']);
