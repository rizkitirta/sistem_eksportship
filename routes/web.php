<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PelabuhanController;
use App\Http\Controllers\Admin\KatalogPelabuhanController;
use App\Http\Controllers\Admin\KatalogContainerController;
use App\Http\Controllers\Admin\ContainerController;
use App\Http\Controllers\Admin\PengirimanController;
use App\Http\Controllers\Admin\TrackingController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\KapalController;
use App\Http\Controllers\Admin\KatalogKapalController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

//Katalog Container
Route::get('/katalog-container/index', [KatalogContainerController::class, 'index'])->name('katalogContainer.index');
Route::post('/katalog-container/store', [KatalogContainerController::class, 'store'])->name('katalogContainer.store');
Route::post('/katalog-container/edit', [KatalogContainerController::class, 'edit'])->name('katalogContainer.edit');
Route::post('/katalog-container/update', [KatalogContainerController::class, 'update'])->name('katalogContainer.update');
Route::post('/katalog-container/destroy', [KatalogContainerController::class, 'destroy'])->name('katalogContainer.destroy');

//Container
Route::get('/container/index', [ContainerController::class, 'index'])->name('container.index');
Route::post('/container/store', [ContainerController::class, 'store'])->name('container.store');
Route::post('/container/edit', [ContainerController::class, 'edit'])->name('container.edit');
Route::post('/container/update', [ContainerController::class, 'update'])->name('container.update');
Route::post('/container/destroy', [ContainerController::class, 'destroy'])->name('container.destroy');

//Katalog Kapal
Route::get('/katalog-kapal/index', [KatalogKapalController::class, 'index'])->name('katalogKapal.index');
Route::post('/katalog-kapal/store', [KatalogKapalController::class, 'store'])->name('katalogKapal.store');
Route::post('/katalog-kapal/edit', [KatalogKapalController::class, 'edit'])->name('katalogKapal.edit');
Route::post('/katalog-kapal/update', [KatalogKapalController::class, 'update'])->name('katalogKapal.update');
Route::post('/katalog-kapal/destroy', [KatalogKapalController::class, 'destroy'])->name('katalogKapal.destroy');

//Kapal
Route::get('/kapal/index', [KapalController::class, 'index'])->name('kapal.index');
Route::post('/kapal/store', [KapalController::class, 'store'])->name('kapal.store');
Route::post('/kapal/edit', [KapalController::class, 'edit'])->name('kapal.edit');
Route::post('/kapal/update', [KapalController::class, 'update'])->name('kapal.update');
Route::post('/kapal/destroy', [KapalController::class, 'destroy'])->name('kapal.destroy');

//Katalog Pelabuhan
Route::get('/katalog-pelabuhan/index', [KatalogPelabuhanController::class, 'index'])->name('katalogPelabuhan.index');
Route::post('/katalog-pelabuhan/store', [KatalogPelabuhanController::class, 'store'])->name('katalogPelabuhan.store');
Route::post('/katalog-pelabuhan/edit', [KatalogPelabuhanController::class, 'edit'])->name('katalogPelabuhan.edit');
Route::post('/katalog-pelabuhan/update', [KatalogPelabuhanController::class, 'update'])->name('katalogPelabuhan.update');
Route::post('/katalog-pelabuhan/destroy', [KatalogPelabuhanController::class, 'destroy'])->name('katalogPelabuhan.destroy');

//Pelabuhan
Route::get('/pelabuhan/index', [PelabuhanController::class, 'index'])->name('pelabuhan.index');
Route::post('/pelabuhan/store', [PelabuhanController::class, 'store'])->name('pelabuhan.store');
Route::post('/pelabuhan/edit', [PelabuhanController::class, 'edit'])->name('pelabuhan.edit');
Route::post('/pelabuhan/update', [PelabuhanController::class, 'update'])->name('pelabuhan.update');
Route::post('/pelabuhan/destroy', [PelabuhanController::class, 'destroy'])->name('pelabuhan.destroy');

//Pengiriman
Route::get('/pengiriman/index', [PengirimanController::class, 'index'])->name('pengiriman.index');
Route::post('/pengiriman/store', [PengirimanController::class, 'store'])->name('pengiriman.store');
Route::post('/pengiriman/edit', [PengirimanController::class, 'edit'])->name('pengiriman.edit');
Route::post('/pengiriman/update', [PengirimanController::class, 'update'])->name('pengiriman.update');
Route::post('/pengiriman/destroy', [PengirimanController::class, 'destroy'])->name('pengiriman.destroy');
//Update Status Pengiriman
Route::post('/pengiriman/status', [PengirimanController::class, 'updateStatus'])->name('pengiriman.status');

//Status
Route::get('/status/index', [StatusController::class, 'index'])->name('status.index');
Route::post('/status/store', [StatusController::class, 'store'])->name('status.store');
Route::post('/status/edit', [StatusController::class, 'edit'])->name('status.edit');
Route::post('/status/update', [StatusController::class, 'update'])->name('status.update');
Route::post('/status/destroy', [StatusController::class, 'destroy'])->name('status.destroy');

//Filter Tracking
Route::get('/tracking/index', [TrackingController::class, 'index'])->name('tracking.index');
Route::get('/tracking/dikemas', [TrackingController::class, 'dikemas'])->name('tracking.dikemas');
Route::get('/tracking/dikirim', [TrackingController::class, 'dikirim'])->name('tracking.dikirim');
Route::get('/tracking/sampai', [TrackingController::class, 'sampai'])->name('tracking.sampai');
Route::get('/tracking/diterima', [TrackingController::class, 'diterima'])->name('tracking.diterima');


//Pengiriman
Route::get('/pengiriman/index', [PengirimanController::class, 'index'])->name('pengiriman.index');
Route::post('/pengiriman/store', [PengirimanController::class, 'store'])->name('pengiriman.store');
Route::post('/pengiriman/edit', [PengirimanController::class, 'edit'])->name('pengiriman.edit');
Route::post('/pengiriman/update', [PengirimanController::class, 'update'])->name('pengiriman.update');
Route::post('/pengiriman/destroy', [PengirimanController::class, 'destroy'])->name('pengiriman.destroy');
//Update Status Pengiriman
Route::post('/pengiriman/status', [PengirimanController::class, 'updateStatus'])->name('pengiriman.status');

//Status
Route::get('/status/index', [StatusController::class, 'index'])->name('status.index');
Route::post('/status/store', [StatusController::class, 'store'])->name('status.store');
Route::post('/status/edit', [StatusController::class, 'edit'])->name('status.edit');
Route::post('/status/update', [StatusController::class, 'update'])->name('status.update');
Route::post('/status/destroy', [StatusController::class, 'destroy'])->name('status.destroy');

//Filter Tracking
Route::get('/tracking/index', [TrackingController::class, 'index'])->name('tracking.index');
Route::get('/tracking/dikemas', [TrackingController::class, 'dikemas'])->name('tracking.dikemas');
Route::get('/tracking/dikirim', [TrackingController::class, 'dikirim'])->name('tracking.dikirim');
Route::get('/tracking/sampai', [TrackingController::class, 'sampai'])->name('tracking.sampai');
Route::get('/tracking/diterima', [TrackingController::class, 'diterima'])->name('tracking.diterima');
