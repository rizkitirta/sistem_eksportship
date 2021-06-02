<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PelabuhanController;
use App\Http\Controllers\Admin\ContainerController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

//Pelabuhan
Route::get('/pelabuhan/index', [PelabuhanController::class, 'index'])->name('pelabuhan.index');
Route::post('/pelabuhan/store', [PelabuhanController::class, 'store'])->name('pelabuhan.store');
Route::post('/pelabuhan/edit', [PelabuhanController::class, 'edit'])->name('pelabuhan.edit');
Route::post('/pelabuhan/update', [PelabuhanController::class, 'update'])->name('pelabuhan.update');
Route::post('/pelabuhan/destroy', [PelabuhanController::class, 'destroy'])->name('pelabuhan.destroy');

//Container
Route::get('/container/index', [ContainerController::class, 'index'])->name('container.index');
Route::post('/container/store', [ContainerController::class, 'store'])->name('container.store');
Route::post('/container/edit', [ContainerController::class, 'edit'])->name('container.edit');
Route::post('/container/update', [ContainerController::class, 'update'])->name('container.update');
Route::post('/container/destroy', [ContainerController::class, 'destroy'])->name('container.destroy');


