<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CertificateController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('welcome'));

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Materi Management
    Route::get('/materis', [MateriController::class, 'index'])->name('admin.materis.index');
    Route::post('/materis', [MateriController::class, 'store'])->name('admin.materis.store');
    Route::get('/materis/{materi}', [MateriController::class, 'show'])->name('admin.materis.show');
    Route::put('/materis/{materi}', [MateriController::class, 'update'])->name('admin.materis.update');
    Route::delete('/materis/{materi}', [MateriController::class, 'destroy'])->name('admin.materis.destroy');

    // Feedback Management
    Route::get('/feedbacks', [FeedbackController::class, 'getAllFeedbacks'])->name('admin.feedbacks.index');
    Route::put('/feedbacks/{feedback}', [FeedbackController::class, 'update'])->name('admin.feedbacks.update');
    Route::delete('/feedbacks/{feedback}', [FeedbackController::class, 'destroy'])->name('admin.feedbacks.destroy');

    // Get Pelatih List
    Route::get('/pelatih', function () {
        $pelatih = User::where('role', 'pelatih')->get();
        return response()->json($pelatih);
    })->name('admin.pelatih.index');
});


/*
|--------------------------------------------------------------------------
| Pelatih Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pelatih'])->prefix('pelatih')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'pelatih'])->name('pelatih.dashboard');

    // Materi Management
    Route::get('/materis', [MateriController::class, 'index'])->name('pelatih.materis.index');
    Route::post('/materis', [MateriController::class, 'store'])->name('pelatih.materis.store');
    Route::get('/materis/{materi}', [MateriController::class, 'show'])->name('pelatih.materis.show');
    Route::put('/materis/{materi}', [MateriController::class, 'update'])->name('pelatih.materis.update');
    Route::delete('/materis/{materi}', [MateriController::class, 'destroy'])->name('pelatih.materis.destroy');

    // Feedback Management
    Route::get('/feedbacks', [FeedbackController::class, 'getFeedbacks'])->name('pelatih.feedbacks.index');
    Route::put('/feedbacks/{feedback}', [FeedbackController::class, 'update'])->name('pelatih.feedbacks.update');
    Route::delete('/feedbacks/{feedback}', [FeedbackController::class, 'destroy'])->name('pelatih.feedbacks.destroy');
});


/*
|--------------------------------------------------------------------------
| Karyawan Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:karyawan'])->group(function () {

    // Dashboard
    Route::get('/karyawan/dashboard', [DashboardController::class, 'karyawanDashboard'])->name('karyawan.dashboard');

    // Sertifikat
    Route::get('/karyawan/sertifikat', [CertificateController::class, 'viewCertificates'])->name('karyawan.sertifikat');
});


/*
|--------------------------------------------------------------------------
| Materi Detail & Feedback Routes (Accessible for authenticated users)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Detail Materi (untuk karyawan)
    Route::get('/materi/{materi}', [MateriController::class, 'apishow'])->name('materi.apishow');

    // Kirim Feedback
    Route::post('/materi/{materi}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // Update Progress
    Route::post('/materi/{materi}/progress', [CertificateController::class, 'updateProgress'])->name('certificate.progress');
});


Route::post('/certificate/{materi}/progress', [CertificateController::class, 'updateProgress'])->name('certificate.progress');
