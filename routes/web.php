<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\KategoriRuanganController;
use App\Http\Controllers\AlatRuanganController;
use App\Http\Controllers\JadwalInspeksiController;
use App\Http\Controllers\JadwalKalibrasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\ReportController;
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


Route::group(['middleware' => ['auth']], function(){

    Route::prefix('home')->group(function(){
        Route::get('total/alat', [HomeController::class, 'totalAlat']);
        Route::get('total/baik', [HomeController::class, 'totalBaik']);
        Route::get('total/rusak', [HomeController::class, 'totalRusak']);
        Route::get('total/wajib-kalibrasi', [HomeController::class, 'totalWajibKalibrasi']);
        Route::get('chart/inspection-act', [HomeController::class, 'inspectionActivity']);
        Route::get('chart/calibration-act', [HomeController::class, 'calibrationActivity']);
        Route::get('total/alat/inspeksi', [HomeController::class, 'totalAlatInspeksi']);
        Route::get('total/alat/kalibrasi', [HomeController::class, 'totalAlatKalibrasi']);
    });

    Route::prefix('table')->group(function(){
        Route::get('alat', [AlatController::class, 'table']);
        Route::get('ruangan', [RuanganController::class, 'table']);
        Route::get('ruangankategori', [KategoriRuanganController::class, 'table']);
        Route::get('alatruangan', [AlatRuanganController::class, 'table']);
        Route::get('inspeksi', [JadwalInspeksiController::class, 'table']);
        Route::get('kalibrasi', [JadwalKalibrasiController::class, 'table']);
        Route::get('perbaikan', [PerbaikanController::class, 'table']);

        Route::get('report/kerusakan', [ReportController::class, 'tableKerusakan']);
        Route::get('report/kalibrasi', [ReportController::class, 'tableKalibrasi']);
    });

    Route::resource('alat', AlatController::class);
    Route::resource('ruangan', RuanganController::class);
    Route::resource('ruangankategori', KategoriRuanganController::class);
    Route::resource('alatruangan', AlatRuanganController::class);
    Route::prefix('alatruangan')->group(function(){
        Route::get('alat/{id}', [AlatRuanganController::class, 'alat']);
        Route::get('ruangan/list', [AlatRuanganController::class, 'ruangan']);
        Route::post('create/schedule/inspection/{id}', [AlatRuanganController::class, 'createInspection']);
        Route::post('create/schedule/calibration', [AlatRuanganController::class, 'createCalibration']);
    });

    Route::resource('inspeksi', JadwalInspeksiController::class);
    Route::prefix('inspeksi')->group(function(){
        Route::post('create/hasil', [JadwalInspeksiController::class, 'createHasil']);
    });

    Route::resource('kalibrasi', JadwalKalibrasiController::class);
    Route::prefix('kalibrasi')->group(function(){
        Route::post('create/hasil', [JadwalKalibrasiController::class, 'createHasil']);
    });

    Route::resource('perbaikan', PerbaikanController::class);
    Route::prefix('perbaikan')->group(function(){
        Route::post('simpan-perbaikan/{id}', [PerbaikanController::class, 'simpanPerbaikan']);
    });

    Route::get('report-kerusakan/', [ReportController::class, 'reportKerusakan']);
    Route::get('report-kalibrasi/', [ReportController::class, 'reportKalibrasi']);

    Route::prefix('rest')->group(function(){
            Route::prefix('ruangankategori')->group(function(){
                Route::post('/update', [KategoriRuanganController::class, 'updateRest']);
                Route::get('/', [KategoriRuanganController::class, 'getRest']);
        });
            Route::prefix('alat')->group(function(){
                Route::post('/update', [AlatController::class, 'updateRest']);
                Route::get('/', [AlatController::class, 'getRest']);
        });
            Route::prefix('ruangan')->group(function(){
                Route::post('/update', [RuanganController::class, 'updateRest']);
                Route::get( '/', [RuanganController::class, 'getRest']);
        });
    });
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});



require __DIR__.'/auth.php';
