<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/data', [App\Http\Controllers\HomeController::class, 'data'])->name('data');

// tempat
Route::get('/tempats', [App\Http\Controllers\TempatController::class, 'index'])->name('tempats.index');
Route::get('/tempats/create', [App\Http\Controllers\TempatController::class, 'create'])->name('tempats.create');
Route::post('/tempats', [App\Http\Controllers\TempatController::class, 'store'])->name('tempats.store');
Route::get('/tempats/{id}/edit', [App\Http\Controllers\TempatController::class, 'edit'])->name('tempats.edit');
Route::put('/tempats/{id}', [App\Http\Controllers\TempatController::class, 'update'])->name('tempats.update');
Route::delete('/tempats/{id}', [App\Http\Controllers\TempatController::class, 'destroy'])->name('tempats.destroy');
Route::post('/validate-password', [App\Http\Controllers\TempatController::class, 'validatePassword'])->name('validate.password');

// booking
Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/create', [App\Http\Controllers\BookingController::class, 'create'])->name('bookings.create');
Route::get('/bookings/download/{id}', [App\Http\Controllers\BookingController::class, 'download'])->name('bookings.download');
Route::get('/bookings/{id}/edit', [App\Http\Controllers\BookingController::class, 'edit'])->name('bookings.edit');
Route::put('/bookings/{id}', [App\Http\Controllers\BookingController::class, 'update'])->name('bookings.update');
Route::delete('/bookings/{id}', [App\Http\Controllers\BookingController::class, 'destroy'])->name('bookings.destroy');
Route::get('/getUserId', [App\Http\Controllers\MasterController::class, 'getUserId'])->name('getUserId');



Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
Route::get('/notifikasi', [App\Http\Controllers\MasterController::class, 'notifikasi'])->name('notifikasi');
Route::get('/bookings/{id}/kwitansi', [App\Http\Controllers\BookingController::class, 'kwitansi'])->name('bookings.kwitansi');


Route::get('/notes', [App\Http\Controllers\NoteController::class, 'index'])->name('notes.index');
Route::get('/notes/{id}/edit', [App\Http\Controllers\NoteController::class, 'edit'])->name('notes.edit');
Route::get('/notes/booking', [App\Http\Controllers\NoteController::class, 'booking'])->name('notes.booking');
Route::get('/notes/create', [App\Http\Controllers\NoteController::class, 'create'])->name('notes.create');
Route::get('/notes/{booking_id}', [App\Http\Controllers\NoteController::class, 'show'])->name('notes.show');
Route::post('/notes', [App\Http\Controllers\NoteController::class, 'store'])->name('notes.store');
Route::get('/notes/{id}', [App\Http\Controllers\NoteController::class, 'destroy'])->name('notes.destroy');
Route::get('/bookings/{id}', [App\Http\Controllers\BookingController::class, 'show'])->name('bookings.show');
Route::get('/bookings/{id}/perpanjang', [App\Http\Controllers\BookingController::class, 'perpanjang'])->name('bookings.perpanjang');
Route::put('/bookings/{id}/perpanjang', [App\Http\Controllers\BookingController::class, 'updatePerpanjang'])->name('bookings.updatePerpanjang');


