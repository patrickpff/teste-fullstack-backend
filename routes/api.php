<?php

use Illuminate\Http\Request;
use App\Http\Controllers\MedicalSpecialtyController;
use App\Http\Controllers\RegionController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->prefix('entities')->group(function () {
    Route::get('/', "EntityController@index");
    Route::post('/', "EntityController@store");
    Route::get('/{id}', "EntityController@show");
    Route::patch('/{id}', "EntityController@update");
    Route::delete('/{id}', "EntityController@destroy");
});

Route::middleware('auth:api')->prefix('medical-specialties')->group(function () {
    Route::get('/', "MedicalSpecialtyController@index");
});

Route::middleware('auth:api')->prefix('regions')->group(function () {
    Route::get('/', "RegionController@index");
});