<?php

use App\Http\Controllers\Admin\ServiceBlock__BlockController;
use App\Http\Controllers\Admin\ServiceFaqUnswerController;
use App\Http\Controllers\Admin\SliderController;
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
Route::put('/service/{id}', [\App\Http\Controllers\Admin\ServiceController::class, 'update']);


Route::post('/images', [\App\Http\Controllers\AttachmentController::class, 'store']);
Route::get('/images', [\App\Http\Controllers\AttachmentController::class, 'file_list']);
Route::delete('/images/{file_id}', [\App\Http\Controllers\AttachmentController::class, 'delete']);


Route::resource('/slider', SliderController::class);
Route::post('/slider_deactivate/{slider_id}', [SliderController::class, 'deactivate']);
Route::post('/slider_activate/{slider_id}', [SliderController::class, 'activate']);

Route::get('/service_block_all', [\App\Http\Controllers\Admin\ServiceBlockController::class, 'index']);
Route::get('/service_block/{serviceBlockId}', [\App\Http\Controllers\Admin\ServiceBlockController::class, 'indexOne']);
Route::get('/service_block_by_service/{serviceId}', [\App\Http\Controllers\Admin\ServiceBlockController::class, 'indexOneByService']);

Route::post('/service_block_set_active_status/{serviceBlockId}', [\App\Http\Controllers\Admin\ServiceBlockController::class, 'setActiveStatus']);

Route::put('/service_block/{serviceBlockId}', [\App\Http\Controllers\Admin\ServiceBlockController::class, 'create']);
Route::delete('/service_block/{serviceBlockId}', [\App\Http\Controllers\Admin\ServiceBlockController::class, 'delete']);

//ServiceBlock__BlockController
Route::delete('/service_block_block/{serviceBlocBlockId}', [ServiceBlock__BlockController::class, 'delete']);
Route::put('/service_block_block', [ServiceBlock__BlockController::class, 'create']);
Route::post('/service_block_block', [ServiceBlock__BlockController::class, 'save']);



Route::get('/service_faq/{service_id}', [ServiceFaqUnswerController::class, 'index']);
Route::delete('/service_faq/{service_id}', [ServiceFaqUnswerController::class, 'delete']);

Route::put('/service_faq/{faq_id}', [ServiceFaqUnswerController::class, 'create']);




Route::get('/service_table/{service_id}', [\App\Http\Controllers\ServiceTableController::class, 'index']);
Route::put('/service_table', [\App\Http\Controllers\ServiceTableController::class, 'create']);
Route::delete('/service_table/{service_id}', [\App\Http\Controllers\ServiceTableController::class, 'delete']);
Route::post('/service_table/', [\App\Http\Controllers\ServiceTableController::class, 'edit']);



