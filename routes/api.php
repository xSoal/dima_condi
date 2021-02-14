<?php

use App\Models\ServiceCategory;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class,'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\AuthController::class, 'me']);

});


Route::group([
    'middleware' => 'auth:api',
], function ($router) {
    Route::get('/service_categories', function(){
        $service_categories = ServiceCategory::all();
        return response()->json($service_categories);
    });

});







Route::get('/service', [\App\Http\Controllers\Admin\ServiceController::class, 'index']);
Route::put('/service', [\App\Http\Controllers\Admin\ServiceController::class, 'add']);
Route::delete('/service/{id}', [\App\Http\Controllers\Admin\ServiceController::class, 'delete']);
