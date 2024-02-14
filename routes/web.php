<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MonthlyPaymentController;
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



Route::resource('teacher',TeacherController::class);
Route::resource('course',CoursesController::class);
Route::resource('discipline',DisciplineController::class);
Route::resource('province',ProvinceController::class);
Route::resource('district',DistrictController::class);
Route::resource('enrollment',EnrollmentController::class);
Route::resource('monthlypayment',MonthlyPaymentController::class);


Route::middleware(['can:accessAdmin, App\Models\Admin'])->group(function () {
    Route::resource('student', StudentController::class);
});

// Route::middleware(['can:accessUser, App\Models\User'])->group(function () {
//     Route::resource('student', StudentController::class)->except('index', 'create', 'update', 'edit');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');