<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\MonthlyPayment;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
    $totalenrollments = Enrollment::count();
        $totalmonthy = MonthlyPayment::sum('price_enrollemnt');
        $formattedTotalMonthly = number_format($totalmonthy, 2, ',', '.');
        return view('dashboard', compact('totalStudents', 'formattedTotalMonthly', 'totalenrollments'));
    }

}