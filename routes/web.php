<?php

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

//Route::get('/', function () {
//    return view('service_page');
//});


Route::get('/', [\App\Http\Controllers\ServicePageController::class, 'index'])->name('home_page');


//Route::get('/admin', [\App\Http\Controllers\Admin\AdminPageController::class, 'index'])->name('admin_page');


Route::get('/admin', function (){
    return view('admin.index');
});

Route::get('/admin/{any}', function (){
    return view('admin.index');
})->where('any', '.{0,}');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
