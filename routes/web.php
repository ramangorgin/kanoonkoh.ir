<?php

use Illuminate\Support\Facades\Route;

// کنترلرهای عمومی سایت
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReportController;

// کنترلرهای ثبت‌نام و ورود
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\LoginController;

// کنترلرهای پنل کاربری
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembershipPaymentController;
use App\Http\Controllers\SportInsuranceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserReportController;

// کنترلرهای پنل مدیریت با alias
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| صفحه اصلی سایت
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'home'])->name('home');

/*
|--------------------------------------------------------------------------
| احراز هویت: ثبت‌نام، ورود، خروج
|--------------------------------------------------------------------------
*/
Route::get('/register', [CustomRegisterController::class, 'showForm'])->name('register');
Route::post('/register', [CustomRegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| پنل کاربری کاربران عادی
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/dashboard/membership/payment', [MembershipPaymentController::class, 'store'])->name('membership.payment');
    Route::post('/dashboard/insurance', [SportInsuranceController::class, 'store'])->name('insurance.store');
    Route::post('/dashboard/tickets', [TicketController::class, 'store'])->name('tickets.store');

    // ارسال گزارش توسط کاربر عادی
    Route::post('/reports/submit', [UserReportController::class, 'store'])->name('user.reports.store');
});

/*
|--------------------------------------------------------------------------
| پنل مدیریت (ادمین)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('programs', AdminProgramController::class);
    Route::resource('courses', AdminCourseController::class);
    Route::resource('reports', AdminReportController::class);

    Route::patch('/membership/payment/{id}/approve', [MembershipPaymentController::class, 'approve'])->name('membership.payment.approve');
});

/*
|--------------------------------------------------------------------------
| بخش عمومی سایت: آرشیو و نمایش
|--------------------------------------------------------------------------
*/
// برنامه‌ها
Route::get('/programs/archive', [ProgramController::class, 'archive'])->name('programs.archive');
Route::get('/programs/{program}', [ProgramController::class, 'show'])->name('programs.show');

// دوره‌ها
Route::get('/courses/archive', [CourseController::class, 'archive'])->name('courses.archive');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// گزارش‌ها
Route::get('/reports/archive', [ReportController::class, 'archive'])->name('reports.archive');
Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
