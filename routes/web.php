<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\InformasiAkademikController;
use App\Http\Controllers\TagihanPembayaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\UserController;

// Arahkan root URL langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard berdasarkan role pengguna
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'kurikulum') {
            return redirect()->route('kurikulum.dashboard');
        } elseif ($user->role === 'guru') {
            return redirect()->route('guru.dashboard');
        } elseif ($user->role === 'murid') {
            return redirect()->route('murid.dashboard');
        }
        return abort(403, 'Akses tidak diizinkan');
    })->name('dashboard');

    Route::middleware(['role:kurikulum'])->group(function () {
        Route::get('/kurikulum', function () {
            return view('dashboard', ['role' => 'kurikulum']);
        })->name('kurikulum.dashboard');
    });

    Route::middleware(['role:guru'])->group(function () {
        Route::get('/guru', function () {
            return view('dashboard', ['role' => 'guru']);
        })->name('guru.dashboard');
    });

    Route::middleware(['role:murid'])->group(function () {
        Route::get('/murid', function () {
            return view('dashboard', ['role' => 'murid']);
        })->name('murid.dashboard');
    });
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


// Profile - hanya tampil, tanpa edit
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

// Jadwal Pelajaran
Route::middleware(['auth', 'role:kurikulum'])->group(function () {
    Route::prefix('akademik')->name('akademik.')->group(function () {
        Route::resource('jadwal', JadwalPelajaranController::class);
    });
});
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('guru/jadwal', [JadwalPelajaranController::class, 'index'])->name('guru.jadwal.index');
});
Route::middleware(['auth', 'role:murid'])->group(function () {
    Route::get('murid/jadwal', [JadwalPelajaranController::class, 'index'])->name('murid.jadwal.index');
});

// Informasi Akademik
Route::middleware(['auth', 'role:kurikulum'])->group(function () {
    Route::prefix('kesiswaan')->name('kesiswaan.')->group(function () {
        Route::resource('informasi-akademik', InformasiAkademikController::class);
    });
});
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('guru/informasi-akademik', [InformasiAkademikController::class, 'index'])->name('guru.informasi-akademik.index');
});
Route::middleware(['auth', 'role:murid'])->group(function () {
    Route::get('murid/informasi-akademik', [InformasiAkademikController::class, 'index'])->name('murid.informasi-akademik.index');
});

// Informasi Tagihan
Route::middleware(['auth', 'role:kurikulum'])->group(function () {
    Route::prefix('kesiswaan')->name('kesiswaan.')->group(function () {
        Route::resource('informasi-tagihan', TagihanPembayaranController::class);
    });
});
Route::middleware(['auth', 'role:murid'])->group(function () {
    Route::get('/murid/kesiswaan/informasi-tagihan', [TagihanPembayaranController::class, 'indexMurid'])->name('murid.kesiswaan.informasi-tagihan.index');
    Route::post('/murid/kesiswaan/informasi-tagihan/upload/{id}', [TagihanPembayaranController::class, 'uploadBukti'])->name('murid.kesiswaan.informasi-tagihan.upload');
    Route::delete('/murid/kesiswaan/informasi-tagihan/delete/{id}', [TagihanPembayaranController::class, 'deleteBukti'])->name('murid.kesiswaan.informasi-tagihan.delete');
});

// Kelas
Route::middleware(['auth', 'role:kurikulum'])->group(function () {
    Route::prefix('akademik')->name('akademik.')->group(function () {
        Route::resource('kelas', KelasController::class);
    });
});
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('guru/kelas', [KelasController::class, 'index'])->name('guru.kelas.index');
});
Route::middleware(['auth', 'role:murid'])->group(function () {
    Route::get('murid/kelas', [KelasController::class, 'index'])->name('murid.kelas.index');
});

// Nilai
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::prefix('akademik')->name('akademik.')->group(function () {
        Route::resource('nilai', NilaiController::class);
    });
});
Route::middleware(['auth', 'role:murid'])->group(function () {
    Route::get('murid/nilai', [NilaiController::class, 'index'])->name('murid.nilai.index');
});

// Tambah Pengguna
Route::middleware(['auth', 'role:kurikulum'])->group(function () {
    Route::prefix('kesiswaan')->name('kesiswaan.')->group(function () {
        Route::resource('tambah-pengguna', UserController::class);
    });
});

// Auth routes dari Laravel Breeze/Fortify
require __DIR__.'/auth.php';
