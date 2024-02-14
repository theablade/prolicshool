<?php

namespace App\Http\Controllers;

use App\Models\Student;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        return view('dashboard', ['user' => $totalStudents]);
    }

}