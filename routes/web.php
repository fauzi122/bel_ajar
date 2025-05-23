<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\PembayaranKegiatanController;
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
// Authentication
Route::prefix('auth')->group( function (){
    Route::controller(LoginController::class)->group(function(){
        Route::get('login','Login')->name('AuthLogin')->middleware('guest');
        Route::post('login','AuthLogin')->name('authenticated');
        Route::post('logout','logout')->name('logout');
    });
    Route::get('/', function () {
        return redirect('auth/login');
    });
});
Route::get('/', function () {
    return redirect('auth/login');
});

// PAGE  ADMIN
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','isAdmin']],function() {
    //  SISWA
        Route::resource('siswa',SiswaController::class);
    //  PETUGAS
        Route::resource('petugas',PetugasController::class)->parameters(['petugas' => 'petugas']);
    //  KELAS
        Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
    //  SPP
        Route::resource('spp',SppController::class);
   // Route untuk tampilan form perubahan password
        Route::get('users/{id}/reset', [ResetPasswordController::class, 'edit'])->name('change-password');
  // Route untuk proses perubahan password
        Route::put('users/{id}/update-password', [ResetPasswordController::class, 'update'])->name('change-password.update');

});

// PAGE  PETUGAS
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','isPetugas']],function() {
    // PAGE DASHBOARD
    Route::get('/',[DashboardController::class,'dashboard'])->name('dashboard.index');
    // PEMBAYARAN
    Route::controller(PembayaranController::class)->group(function(){
        Route::get('pembayaran/{kwitansi:nis}/kwitansi', 'kwitansi')->name('kwitansi');
        Route::get('transaksi', 'transaksi')->name('pembayaran.transaksi');
        Route::get('pembayaran/{siswa:nisn}/create', 'create')->name('pembayaran.create');

        Route::get('pembayaran/tunggakan','tunggakan')->name('tunggakan');
        Route::get('pembayaran/tunggakan/cetak/{kelas:id}','cetakTunggakan')->name('tunggakan.cetak');

        Route::get('pembayaran/laporan','laporan')->name('laporan');
        Route::get('pembayaran/laporan/rekap-kelas/{kelas:id}','rekapLaporan')->name('laporan.rekap');
        Route::resource('pembayaran', PembayaranController::class)->only(['index','store','destroy']);
    });

    Route::controller(PembayaranKegiatanController::class)->group(function(){
        Route::get('pembayaran-kegiatan', 'index')->name('kegiatan');
        Route::get('pembayaran/uts-uas', 'ujian')->name('pembayaranujian.index');
        Route::get('pembayaran-kegiatan/{siswa:nisn}/create', 'create')->name('pembayaran.kegiatan.create');
        Route::post('pembayaran-kegiatan/store', 'store')->name('pembayaran.kegiatan.store');
       
    });
});
