<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Polsek\PengajuanController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\RelatedLinkController;
use App\Http\Controllers\LocatorController;
use App\Http\Controllers\Admin\PoliceStationController;
use App\Http\Controllers\PageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== ROUTE PUBLIK (GUEST) ====================
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/lokasi-kantor', [App\Http\Controllers\LocatorController::class, 'index'])->name('locator.index');
Route::get('/kebijakan-privasi', [App\Http\Controllers\PageController::class, 'privacy'])->name('kebijakan-privasi');

// ==================== AUTH & PROFILE ROUTES ====================
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isSuperAdmin() || $user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('polsek.beranda');
    })->middleware('verified')->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/notifications/markAsRead', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});

// ==================== GRUP RUTE ADMIN (UNTUK SUPERADMIN & POLRES) ====================
Route::middleware(['auth', 'role:superadmin,polres'])->prefix('admin')->as('admin.')->group(function () {

    // --- Rute yang bisa diakses KEDUA role (Superadmin & Polres) ---
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pengajuan/{pengajuan}', [App\Http\Controllers\Admin\DashboardController::class, 'show'])->name('pengajuan.show');
    Route::post('/pengajuan/{pengajuan}/update-status', [App\Http\Controllers\Admin\DashboardController::class, 'updateStatus'])->name('pengajuan.updateStatus');
    Route::delete('/pengajuan/{pengajuan}/delete-reply-image', [App\Http\Controllers\Admin\DashboardController::class, 'deleteReplyImage'])->name('pengajuan.deleteReplyImage');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('police-stations', App\Http\Controllers\Admin\PoliceStationController::class);

    // --- Rute yang HANYA bisa diakses oleh SUPERADMIN ---
    Route::middleware(['role:superadmin'])->group(function () {
        Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
        Route::resource('homepage-sections', App\Http\Controllers\Admin\HomepageSectionController::class);
        Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class);
        Route::resource('related-links', App\Http\Controllers\Admin\RelatedLinkController::class);
        Route::resource('reply-templates', App\Http\Controllers\Admin\ReplyTemplateController::class);
    });
});

// ==================== GRUP RUTE POLSEK (USER) ====================
Route::middleware(['auth', 'verified', 'role:polsek'])->prefix('polsek')->as('polsek.')->group(function () {
    Route::get('/beranda', [App\Http\Controllers\Polsek\PengajuanController::class, 'index'])->name('beranda');
    Route::get('/ajukan-anggaran', [App\Http\Controllers\Polsek\PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/ajukan-anggaran', [App\Http\Controllers\Polsek\PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/riwayat-pengajuan', [App\Http\Controllers\Polsek\PengajuanController::class, 'riwayat'])->name('pengajuan.riwayat');
    Route::get('/riwayat-pengajuan/{pengajuan}', [App\Http\Controllers\Polsek\PengajuanController::class, 'show'])->name('pengajuan.show');
});
