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

// داشبورد کاربر
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\MembershipController;
use App\Http\Controllers\Dashboard\TicketController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\ParticipationController;

// ادمین
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| صفحه اصلی و عمومی
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
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
| گزارش‌ها
|--------------------------------------------------------------------------
*/
Route::get('/reports', [ReportPublicController::class, 'index'])->name('reports.index');
Route::get('/reports/{id}', [ReportPublicController::class, 'show'])->name('reports.show');

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
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('index');

    // پروفایل
    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // بیمه
    Route::get('insurance', [InsuranceController::class, 'show'])->name('insurance');
    Route::post('insurance', [InsuranceController::class, 'store'])->name('insurance.store');
    Route::post('insurance/update', [InsuranceController::class, 'update'])->name('insurance.update');

    // عضویت
    Route::get('membership', [MembershipController::class, 'create'])->name('membership');
    Route::post('membership', [MembershipController::class, 'store'])->name('membership.store');
    Route::post('membership/submit', [MembershipController::class, 'submit'])->name('membership.submit');


    // تیکت‌ها
    Route::resource('tickets', TicketController::class)->only(['index', 'create', 'store', 'show']);

    // گزارش‌ها
    Route::resource('reports', ReportController::class)->only(['index', 'create', 'store', 'show']);

    // مشارکت
    Route::get('participation', [ParticipationController::class, 'index'])->name('participation');
});

/*
|--------------------------------------------------------------------------
| پنل ادمین
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
});
