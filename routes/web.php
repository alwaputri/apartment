<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
Route::get('/', [KamarController::class, 'dashboard'])->name('dashboard');
Route::get('/available-rooms', [KamarController::class, 'availableRooms'])->name('available-rooms');
Route::get('/checkout', [KamarController::class, 'checkoutRooms'])->name('checkout');
Route::get('/latecheckout', [KamarController::class, 'latecheckoutRooms'])->name('latecheckout');
Route::get('/rooms/create', [KamarController::class, 'createroom'])->name('room.tambah');
Route::post('/rooms', [KamarController::class, 'storeroom'])->name('room.store');
Route::get('/kamars', [KamarController::class, 'index'])->name('kamars.index');
Route::get('/DaftarPenghuni', [KamarController::class, 'daftarpenghuni'])->name('kamars.daftarpenghuni');
Route::get('/room/{id}', [KamarController::class, 'viewDetail'])->name('room.detail');
Route::get('/room/{id}/add-tenant', [KamarController::class, 'addTenant'])->name('room.add.tenant');
Route::post('/room/{id}/store-tenant', [KamarController::class, 'storeTenant'])->name('room.store.tenant');
Route::put('/kamar/{id}/checkout/{reservation_id}', [KamarController::class, 'checkout'])->name('checkout.kamar');
Route::get('/booking', [KamarController::class, 'bookingStatus'])->name('booking.status');
Route::get('room/delete/{id}', [KamarController::class,'deleteRoom'])->name('room.delete');
Route::get('/filter-bookings', [KamarController::class,'filterBookings'])->name('filterBookings');
Route::get('/search-penghuni', [KamarController::class,'searchPenghuni'])->name('searchPenghuni');
Route::get('/customer/{id}', [KamarController::class, 'detailPenghuni'])->name('customer.detail');

});
Route::controller(AuthController::class)->group(function () {

	Route::get('login', 'login')->name('login');
	Route::post('login', 'loginAksi')->name('login.aksi');

	Route::get('logout', 'logout')->middleware('auth')->name('logout');
});