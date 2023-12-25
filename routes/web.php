<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fornt\SliderController;
use App\Http\Controllers\fornt\EmailController;
use App\Http\Controllers\QuotationController;


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


Route::get('/' , [SliderController::class,'view']);

Route::get('/blog' , [SliderController::class,'index']);
Route::get('/blog/{id}' , [SliderController::class,'index'])->name('blog');
Route::get('/about' ,[SliderController::class,'about']);
Route::get('/about/{id}' , [SliderController::class,'about'])->name('about');

Route::post('email',[EmailController::class,'manage_process'])->name('email');
Route::get('/quotation' ,[SliderController::class,'quotation'])->name('quotation');


Route::get('/get-filtered-data/{id}', [SliderController::class,'getFilteredData'])->name('getFilteredData');
Route::get('/get-pump-data/{id}', [SliderController::class,'getPumpData'])->name('getPumpData');
Route::get('/get-light-data/{id}', [SliderController::class,'getLightData'])->name('getLightData');
Route::get('/get-inlet-data/{id}', [SliderController::class,'getInletData'])->name('getInletData');
Route::get('/get-maindrain-data/{id}', [SliderController::class,'getMainDrainData'])->name('getMainDrainData');
Route::get('/get-vacuum-data/{id}', [SliderController::class,'getVacuumData'])->name('getVacuumData');
Route::get('/get-heaterpump-data/{id}', [SliderController::class,'getHeaterPumpData'])->name('getHeaterPumpData');
Route::get('/get-ozone-data/{id}', [SliderController::class,'getOzoneData'])->name('getOzoneData');

Route::post('/calculate-total-price', [SliderController::class, 'calculateTotalPrice'])->name('calculateTotalPrice');

