<?php

use Illuminate\Support\Facades\Route;

// ──────────────── Public Controllers ────────────────
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\Public\ReportController as PublicReportController;

// ──────────────── Auth Controllers ────────────────
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ──────────────── User Panel Controllers ────────────────
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\UserPaymentController;
use App\Http\Controllers\UserReportController;
use App\Http\Controllers\UserTicketController;
use App\Http\Controllers\UserProgramController;

// ──────────────── Admin Panel Controllers ────────────────
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// ──────────────── Public Site Pages ────────────────
Route::get('/', [PublicPageController::class, 'home'])->name('home');
Route::get('/programs', [PublicPageController::class, 'programs'])->name('programs.archive');
Route::get('/courses', [PublicPageController::class, 'courses'])->name('courses.archive');
Route::get('/reports/archive', [PublicPageController::class, 'reports'])->name('reports.archive');
Route::get('/reports/{report}', [PublicReportController::class, 'show'])->name('public.reports.show');
Route::get('/about', [PublicPageController::class, 'about'])->name('about');
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');


// ──────────────── Auth Routes ────────────────
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ──────────────── User Panel (auth required) ────────────────
Route::middleware('auth')->group(function () {

    // Dashboard & Profile
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile', [DashboardController::class, 'update'])->name('profile.update');

    // Courses
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/my-courses', [UserCourseController::class, 'index'])->name('user.courses');
    Route::post('/my-courses/request', [UserCourseController::class, 'requestCourse'])->name('user.courses.request');
    Route::post('/courses/{course}/register', [UserCourseController::class, 'register'])->name('user.courses.register');

    // Programs
    Route::post('/my-programs/request', [UserProgramController::class, 'request'])->name('user.programs.request');
    Route::post('/programs/{program}/register', [UserProgramController::class, 'register'])->name('user.programs.register');

    // Payments
    Route::get('/payments', [UserPaymentController::class, 'index'])->name('user.payments');
    Route::post('/payments', [UserPaymentController::class, 'store'])->name('user.payments.store');

    // Reports
    Route::get('/reports', [UserReportController::class, 'index'])->name('user.reports');
    Route::post('/reports', [UserReportController::class, 'store'])->name('user.reports.store');

    // Tickets
    Route::get('/tickets', [UserTicketController::class, 'index'])->name('user.tickets');
    Route::post('/tickets', [UserTicketController::class, 'store'])->name('user.tickets.store');
    Route::post('/tickets/{ticket}/reply', [UserTicketController::class, 'reply'])->name('user.tickets.reply');
});

// ──────────────── Admin Panel Routes ────────────────
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {

    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Programs
    Route::resource('/programs', AdminProgramController::class)->names('admin.programs');
    Route::get('/programs/{program}/registrations', [AdminProgramController::class, 'registrations'])->name('admin.programs.registrations');
    Route::post('/registrations/{registration}/approve', [AdminProgramController::class, 'approveRegistration'])->name('admin.programs.registrations.approve');
    Route::post('/registrations/{registration}/reject', [AdminProgramController::class, 'rejectRegistration'])->name('admin.programs.registrations.reject');

    // Courses
    Route::resource('/courses', AdminCourseController::class)->names('admin.courses');
    Route::get('/courses/{course}/registrations', [AdminCourseController::class, 'registrations'])->name('admin.courses.registrations');
    Route::post('/course-registrations/{registration}/approve', [AdminCourseController::class, 'approveRegistration'])->name('admin.courses.registrations.approve');
    Route::post('/course-registrations/{registration}/reject', [AdminCourseController::class, 'rejectRegistration'])->name('admin.courses.registrations.reject');

    // Reports
    Route::resource('/reports', AdminReportController::class)->names('admin.reports');

    // Tickets
    Route::resource('/tickets', AdminTicketController::class)->names('admin.tickets');
    Route::post('/tickets/{ticket}/reply', [AdminTicketController::class, 'reply'])->name('admin.tickets.reply');

    // Payments
    Route::resource('/payments', AdminPaymentController::class)->names('admin.payments');

    // Users
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
});




