<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Controller Sisi Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OwnerVerificationController;
use App\Http\Controllers\Admin\PropertyVerificationController;
use App\Http\Controllers\Admin\UserManagementController; 
use App\Http\Controllers\Admin\ModerationController;

// Controller Sisi Owner
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\PropertyController as OwnerPropertyController;
use App\Http\Controllers\Owner\ReportController as OwnerReportController;

// Controller Sisi Mahasiswa
use App\Http\Controllers\Mahasiswa\PropertySearchController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\BookingController; // 🌟 TAMBAHAN: Import Controller Booking
use App\Http\Controllers\Mahasiswa\SurveyController;  // 🌟 TAMBAHAN: Import Controller Survey

/*
|--------------------------------------------------------------------------
| Web Routes - StayFind Platform
|--------------------------------------------------------------------------
*/

// ====================================================================
// 🌐 1. RUTE PUBLIK (Bisa Diakses Siapa Saja Termasuk Tamu/Guest)
// ====================================================================

// Landing Page Utama
Route::get('/', [PropertySearchController::class, 'landing'])->name('public.home');
Route::get('/about', function () { return view('public.about'); })->name('public.about');
Route::get('/cari-kost', [PropertySearchController::class, 'index'])->name('mahasiswa.index');
Route::get('/kost/{id}', [PropertySearchController::class, 'show'])->name('mahasiswa.show');


// ====================================================================
// 🔑 2. RUTE AUTENTIKASI
// ====================================================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [AuthController::class, 'land'])->name('public.home');


// ====================================================================
// 🛡️ 3. RUTE INTERNAL (WAJIB LOGIN)
// ====================================================================
Route::middleware(['auth'])->group(function () {

    // ================= 👨‍🎓 ROLE MAHASISWA =================
    // 🌟 PERBAIKAN: Ditambahkan prefix nama rute 'mahasiswa.' agar sinkron dengan sidebar
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');
        
        // Riwayat & Aksi Pemesanan Kost (Sekarang otomatis: mahasiswa.bookings.index / create / store)
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
        
        // Riwayat Survei & Ulasan Saya
        // Tambahkan ini di dalam group Route::middleware('role:mahasiswa')...
        Route::get('/surveys/create', [SurveyController::class, 'create'])->name('surveys.create');
        Route::post('/surveys', [SurveyController::class, 'store'])->name('surveys.store');
        Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');
        Route::get('/reviews', [App\Http\Controllers\Mahasiswa\ReviewController::class, 'index'])->name('reviews.index');
        Route::get('/reviews/create', [App\Http\Controllers\Mahasiswa\ReviewController::class, 'create'])->name('reviews.create');
        Route::post('/reviews', [App\Http\Controllers\Mahasiswa\ReviewController::class, 'store'])->name('reviews.store');
        
        // Fitur Pesan/Chat Internal
        Route::get('/messages', [App\Http\Controllers\Mahasiswa\MessageController::class, 'index'])->name('messages.index');
        Route::post('/messages', [App\Http\Controllers\Mahasiswa\MessageController::class, 'store'])->name('messages.store');
    });

    // ================= 🏠 ROLE OWNER =================
    Route::middleware(['role:owner', 'verified.owner'])->group(function () {
        Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');
        
        // CRUD Properti Kost Owner
        Route::get('/owner/properties', [OwnerPropertyController::class, 'index'])->name('owner.properties.index');
        Route::get('/owner/properties/create', [OwnerPropertyController::class, 'create'])->name('owner.properties.create');
        Route::post('/owner/properties', [OwnerPropertyController::class, 'store'])->name('owner.properties.store');
        Route::get('/owner/properties/{id}/edit', [OwnerPropertyController::class, 'edit'])->name('owner.properties.edit');
        Route::put('/owner/properties/{id}', [OwnerPropertyController::class, 'update'])->name('owner.properties.update');
        Route::delete('/owner/properties/{id}', [OwnerPropertyController::class, 'destroy'])->name('owner.properties.destroy');
        
        // Manajemen Operasional Owner
        Route::get('/owner/bookings', [App\Http\Controllers\Owner\BookingController::class, 'index'])->name('owner.bookings.index');
        Route::put('/owner/bookings/{id}', [App\Http\Controllers\Owner\BookingController::class, 'updateStatus'])->name('owner.bookings.update');
        Route::get('/owner/surveys', [App\Http\Controllers\Owner\SurveyController::class, 'index'])->name('owner.surveys.index');
        Route::get('/owner/reviews', [App\Http\Controllers\Owner\ReviewController::class, 'index'])->name('owner.reviews.index');
        Route::get('/owner/reports', [OwnerReportController::class, 'index'])->name('owner.reports.index');

        // Tambahkan baris ini di dalam grup middleware role:owner kamu:
        Route::put('/owner/surveys/{id}', [App\Http\Controllers\Owner\SurveyController::class, 'updateStatus'])->name('owner.surveys.update');
    });

    // ================= ⚙️ ROLE ADMIN =================
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Verifikasi Akun Owner Baru
        Route::get('/admin/owners', [OwnerVerificationController::class, 'index'])->name('admin.owners.index');
        Route::put('/admin/owners/{id}/verify', [OwnerVerificationController::class, 'verify'])->name('admin.owners.verify');
        
        // Verifikasi Publikasi Iklan Kost Baru
        Route::get('/admin/properties', [PropertyVerificationController::class, 'index'])->name('admin.properties.index');
        Route::put('/admin/properties/{id}/verify', [PropertyVerificationController::class, 'verify'])->name('admin.properties.verify');
        
        // Manajemen User
        Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
        Route::delete('/admin/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');
        
        // Moderasi Konten Ulasan
        Route::get('/admin/moderation', [ModerationController::class, 'index'])->name('admin.moderation.index');
        Route::put('/admin/moderation/{id}/hide', [ModerationController::class, 'hide'])->name('admin.moderation.hide');
    });

});