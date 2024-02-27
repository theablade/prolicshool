<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MonthlyPaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\MonthlyPayment;
use App\Models\Enrollment;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});







Route::middleware(['can:accessAdmin, App\Models\Admin'])->group(function () {
   Route::get('/resgistro', function () {

    return view('auth.register');
    
});
Route::resource('teacher',TeacherController::class);
Route::resource('course',CoursesController::class);
Route::resource('discipline',DisciplineController::class);
Route::resource('province',ProvinceController::class);
Route::resource('district',DistrictController::class);
Route::resource('enrollment',EnrollmentController::class);
Route::resource('monthlypayment',MonthlyPaymentController::class);
Route::resource('dashboard',DashboardController::class);
Route::resource('student', StudentController::class);
});

Route::middleware(['can:accessUser, App\Models\User'])->group(function () {
    Route::resource('student', StudentController::class)->except('index', 'create', 'update', 'edit');
});


Auth::routes();