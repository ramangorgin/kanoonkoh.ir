<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\MainController;
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

// داشبورد کاربر
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\MembershipController;
use App\Http\Controllers\Dashboard\TicketController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\ParticipationController;

use App\Http\Controllers\Dashboard\SettingsController;


use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/conditions', 'conditions')->name('conditions');
Route::view('/contact/confirm', 'contact-confirm')->name('contact.confirm');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program}', [ProgramController::class, 'show'])->name('programs.show');
Route::middleware('auth')->post('/programs/{program}/register', [ProgramRegistrationController::class, 'store'])->name('programs.register');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::middleware('auth')->post('/courses/{course}/register', [CourseRegistrationController::class, 'store'])->name('courses.register');

Route::get('/reports', [ReportPublicController::class, 'index'])->name('reports.index');
Route::get('/reports/{id}', [ReportPublicController::class, 'show'])->name('reports.show');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('index');
    
    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('insurance', [InsuranceController::class, 'show'])->name('insurance');
    Route::post('insurance', [InsuranceController::class, 'store'])->name('insurance.store');
    Route::post('insurance/update', [InsuranceController::class, 'update'])->name('insurance.update');
    
    Route::get('membership', [MembershipController::class, 'index'])->name('membership');
    Route::get('membership/create', [MembershipController::class, 'create'])->name('membership.create');
    Route::post('membership/submit', [MembershipController::class, 'store'])->name('membership.submit');
    
    Route::get('membership', [MembershipController::class, 'index'])->name('membership');
    Route::get('membership/create', [MembershipController::class, 'create'])->name('membership.create');
    Route::post('membership/submit', [MembershipController::class, 'store'])->name('membership.submit');

    Route::resource('tickets', TicketController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('reports', ReportController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('participation', [ParticipationController::class, 'index'])->name('participation');

    Route::post('/settings/update-password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');

});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
});

