<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [App\Http\Controllers\System::class, 'login']);
Route::post('/logout', [App\Http\Controllers\System::class, 'logout']);

Route::group(['middleware' => 'auth.jwt', 'prefix' => 'plans'], function () {
    Route::get('/', [App\Http\Controllers\Holiday_Plans::class, 'list']);
    Route::get('/{plan_id}', [App\Http\Controllers\Holiday_Plans::class, 'get_plan']);
    Route::get('/{plan_id}/document', [App\Http\Controllers\Holiday_Plans::class, 'get_plan_document']);
    Route::post('/', [App\Http\Controllers\Holiday_Plans::class, 'create']);
    Route::match(['put', 'patch'], '/{plan_id}/', [App\Http\Controllers\Holiday_Plans::class, 'update']);
    Route::delete('/{plan_id}/', [App\Http\Controllers\Holiday_Plans::class, 'delete']);
});
