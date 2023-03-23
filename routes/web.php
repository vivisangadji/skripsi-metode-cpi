<?php

use App\Http\Controllers\ProfileController;
use App\Models\Perhitungan;
use App\Models\Kost;
use App\Models\Kriteria;
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

Route::get('/', [App\Http\Controllers\UserController::class,'index'])->name('index');
Route::post('/cari-kriteria', [App\Http\Controllers\UserController::class,'KostFilter'])->name('kost.filter');
// Route::get('/cari-kriteria', [App\Http\Controllers\UserController::class,'showKostFilter'])->name('kost.filter');
// Route::post('/cari-kriteria/{one?}/{two?}/{three?}/{four?}/{five?}', [App\Http\Controllers\UserController::class,'showKostFilter'])->name('kost.filter');
Route::get('/all-kost', [App\Http\Controllers\UserController::class,'allKost'])->name('all.kost');
Route::get('/detail/{id}', [App\Http\Controllers\UserController::class,'detail'])->name('detail.kost');
Route::get('/data-hasil-perhitungan', [App\Http\Controllers\UserController::class,'perhitungan'])->name('data.hasil');

Route::get('/dashboard', function () {
    $perhitungan = count(Perhitungan::all());
    $kost = count(Kost::all());
    $kriteria = count(Kriteria::all());
    return view('dashboard',compact('perhitungan','kost','kriteria'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('kost', App\Http\Controllers\KostController::class);
    Route::resource('kriteria', App\Http\Controllers\KriteriaController::class);
    Route::resource('cpi', App\Http\Controllers\PerhitunganCpiController::class);
    Route::get('/transformasi/cpi', [App\Http\Controllers\PerhitunganCpiController::class, 'transformasiCpi'])->name('transfor.cpi');
});


require __DIR__.'/auth.php';
