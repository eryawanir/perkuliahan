<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/jurusans');
});

Route::resource('jurusans', JurusanController::class);
Route::resource('dosens', DosenController::class);
Route::resource('mahasiswas', MahasiswaController::class);
Route::resource('matakuliahs', MatakuliahController::class);

Route::get('/jurusan-dosen/{jurusan_id}', [
    JurusanController::class,
    'dosen'
])->name('jurusan-dosen');
Route::get('/jurusan-mahasiswa/{jurusan_id}', [
    JurusanController::class,
    'mahasiswa'
])->name('jurusan-mahasiswa');
Route::get(
    '/mahasiswas/ambil-matakuliah/{mahasiswa}',
    [MahasiswaController::class, 'ambilMatakuliah']
)
    ->name('ambil-matakuliah');
Route::post(
    '/mahasiswas/ambil-matakuliah/{mahasiswa}',
    [MahasiswaController::class, 'prosesAmbilMatakuliah']
)
    ->name('proses-ambil-matakuliah');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
