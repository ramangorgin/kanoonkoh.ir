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
use App\Http\Controllers\Dashboard\MembershipController;
use App\Http\Controllers\Dashboard\TicketController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\ParticipationController;

/*
|--------------------------------------------------------------------------
| صفحه اصلی و عمومی
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->name('home');

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
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('insurance', [InsuranceController::class, 'show'])->name('insurance');
    Route::post('insurance', [InsuranceController::class, 'store'])->name('insurance.store');
    Route::post('insurance/update', [InsuranceController::class, 'update'])->name('insurance.update');

    Route::get('membership', [MembershipController::class, 'index'])->name('membership');
    Route::get('membership/create', [MembershipController::class, 'create'])->name('membership.create');
    Route::post('membership/submit', [MembershipController::class, 'store'])->name('membership.submit');

    Route::resource('tickets', TicketController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('reports', ReportController::class)->except(['destroy']);

    Route::get('settings', [DashboardController::class, 'settings'])->name('settings');
    Route::get('participation', [ParticipationController::class, 'index'])->name('participation');
});
