<?php

use App\Http\Controllers\FourShareController;
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

Route::get('/getinfo/{link4share}', [FourShareController::class, 'index'])->where('link4share', '.*');
Route::get('/search/{keyword}', [FourShareController::class, 'searchName'])->where('keyword', '.*');
Route::get('/infofile/{id}', [FourShareController::class, 'infoFile']);
Route::post('/popular', [FourShareController::class, 'getPopularLink']);
Route::post('/updateaccess', [FourShareController::class, 'updateAccessCount']);
