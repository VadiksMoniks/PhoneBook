<?php

use VadiksMoniks\PhoneBook\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

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

Route::view('/','phone-book::index');

Route::get('/list/{page?}', [RecordController::class, 'index']);
Route::get('/contacts/{pattern}', [RecordController::class, 'searchByPattern']);

Route::post('/store', [RecordController::class, 'store']);
Route::put('/update', [RecordController::class, 'update']);
Route::delete('/{id}/delete', [RecordController::class, 'delete']);
