<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MonthlyPaymentController;
use App\Http\Controllers\ExpensesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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






Route::get('/resgistro', function () {
       
       return view('auth.register');
       
   })->can('accessAdmin');


Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::middleware(['can:access'])->group(function (){


});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
    Route::resource('teacher',TeacherController::class);
    Route::resource('Userdashboard',UserDashboardController::class);
    Route::resource('student', StudentController::class);
    Route::resource('course', CoursesController::class);
    Route::resource('discipline', DisciplineController::class);
    Route::resource('province', ProvinceController::class);
    Route::resource('district', DistrictController::class);
    Route::resource('enrollment', EnrollmentController::class);
    Route::resource('monthlypayment', MonthlyPaymentController::class);
    Route::resource('expenses', ExpensesController::class);
    Route::get('student.pdf', [StudentController::class, 'PDFLimpo'])->name('students.pdf');
    Route::get('monthypayments.pdf', [MonthlyPaymentController::class, 'PDFLimpo'])->name('monthypayments.pdf');
    Route::get('enrollments.pdf', [EnrollmentController::class, 'PDFLimpo'])->name('enrollments.pdf');
    Route::get('enrollment.pdf/{parametro}', [EnrollmentController::class, 'PDFUser'])->name('enrollment.pdf');
    Route::get('enrollment.pdfr/{parametro}', [EnrollmentController::class, 'ReciboUser'])->name('enrollment.pdfr');
    Route::get('monthypayment.pdf/{parametro}', [MonthlyPaymentController::class, 'PDFUser'])->name('monthypayment.pdf');
    Route::get('student.pdf/{parametro}', [StudentController::class, 'PDFUser'])->name('studentx.pdf');
    Route::get('teacher.pdf', [TeacherController::class, 'PDFLimpo'])->name('teacher.pdf');
    Route::get('teacher.pdf/{parametro}', [TeacherController::class, 'PDFUser'])->name('teacherx.pdf');
   


Auth::routes();