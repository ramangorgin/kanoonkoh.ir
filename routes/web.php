<?php

use Illuminate\Support\Facades\Route;

// عمومی
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

// برنامه‌ها
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramRegistrationController;

// دوره‌ها
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseRegistrationController;

// گزارش‌های عمومی
use App\Http\Controllers\ReportPublicController;

// احراز هویت
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// داشبورد
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\TicketController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\ReportController;

/*
|--------------------------------------------------------------------------
| صفحه اصلی و عمومی
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::view('/conditions', 'conditions')->name('conditions');
Route::view('/contact/confirm', 'contact-confirm')->name('contact.confirm');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| برنامه‌ها
|--------------------------------------------------------------------------
*/
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program}', [ProgramController::class, 'show'])->name('programs.show');
Route::middleware('auth')->post('/programs/{program}/register', [ProgramRegistrationController::class, 'store'])->name('programs.register');

/*
|--------------------------------------------------------------------------
| دوره‌ها
|--------------------------------------------------------------------------
*/
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::middleware('auth')->post('/courses/{course}/register', [CourseRegistrationController::class, 'store'])->name('courses.register');

/*
|--------------------------------------------------------------------------
| گزارش‌های عمومی
|--------------------------------------------------------------------------
*/
Route::get('/reports', [ReportPublicController::class, 'index'])->name('reports.index');
Route::get('/reports/{id}', [ReportPublicController::class, 'show'])->name('reports.show');
Route::post('/reports/create', [ReportPublicController::class, 'store'])->name('dashboard.reports.store');

/*
|--------------------------------------------------------------------------
| احراز هویت
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| داشبورد کاربر
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/courses', [DashboardController::class, 'courses'])->name('dashboard.courses');
        Route::get('/programs', [DashboardController::class, 'programs'])->name('dashboard.programs');

        Route::get('/profile', [ProfileController::class, 'show'])->name('dashboard.profile');
        Route::post('/profile', [ProfileController::class, 'store'])->name('dashboard.profile.store');
    
        Route::get('/insurance', [InsuranceController::class, 'show'])->name('dashboard.insurance');
        Route::post('/insurance', [InsuranceController::class, 'store'])->name('dashboard.insurance.store');
        Route::patch('/insurance', [InsuranceController::class, 'update'])->name('dashboard.insurance.update');
        
        Route::get('/payments', [PaymentController::class, 'index'])->name('dashboard.payments');
        Route::post('/payments/store', [PaymentController::class, 'store'])->name('dashboard.payment.store');

        Route::get('/tickets', [TicketController::class, 'index'])->name('dashboard.tickets.index');
        Route::get('/tickets/create', [TicketController::class, 'create'])->name('dashboard.tickets.create');
        Route::post('/tickets/create', [TicketController::class, 'store'])->name('dashboard.tickets.store');

        Route::get('/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
        Route::post('/settings', [SettingsController::class, 'updatePassword'])->name('dashboard.settings.updatePassword');

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('dashboard.reports.index');
        Route::get('/reports/create', [ReportController::class, 'create'])->name('dashboard.reports.create');
        Route::get('/reports/edit', [ReportController::class, 'edit'])->name('dashboard.reports.edit');
        Route::get('/reports/show', [ReportController::class, 'show'])->name('dashboard.reports.show');
        Route::post('/reports/create', [ReportController::class, 'store'])->name('dashboard.reports.create');

    });
});