
Laravel Project Summary & Issue Report
======================================

Project Name: KanoonKoh (Mountaineering Club Website)
Framework: Laravel 10+
Project Type: Membership & Content Management System
Frontend Framework: Bootstrap
Database: MySQL (via XAMPP)

Features & Modules Implemented
------------------------------
User Roles:
- Guest: Can view programs/courses/reports.
- Registered User:
  - Edit profile
  - Upload sports insurance
  - View joined programs/courses
  - Submit mountaineering reports
- Admin:
  - Admin dashboard
  - Manage programs, courses, reports
  - Confirm membership payments
  - Access analytics

Core Models & Tables:
- User
- Program
- Course
- Report
- Ticket
- MembershipPayment
- SportInsurance

Controller Structure:
- HomeController: Public homepage
- CustomRegisterController: Custom registration
- LoginController: Auth system
- DashboardController: User panel
- MembershipPaymentController, TicketController, SportInsuranceController
- UserReportController
- Admin Controllers: ProgramController, CourseController, ReportController, AdminDashboardController

Middleware:
- AdminMiddleware (checks if user is_admin)
- Registered in App\Http\Kernel.php as 'admin'

Routes:
- Public Routes
- Auth Routes (register, login, logout)
- User Dashboard Routes (with 'auth' middleware)
- Admin Routes (with 'auth' and 'admin' middleware and '/admin' prefix)

Issue
-----
Error Message:
Illuminate\Contracts\Container\BindingResolutionException
Target class [admin] does not exist.

Description:
This error appears when accessing routes with ['auth', 'admin'] middleware.
All middleware files exist and are properly configured.

What Works:
- Middleware class exists and registered
- Artisan route:list shows all routes
- User features work
- Controllers are in correct namespace
- Routes work when 'admin' middleware is removed

What Was Tried:
- Clearing Laravel caches
- Validating middleware registration
- Composer autoload dump

Possibly Related:
- Laravel attempting to resolve 'admin' as a controller
- Route cache corruption
- Class alias conflict

Summary:
A fully functional Laravel system with middleware error blocking admin access.

Help Needed:
- Fresh eyes on middleware resolution logic and possible Laravel bootstrap caching issue.

