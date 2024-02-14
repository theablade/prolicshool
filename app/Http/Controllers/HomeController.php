<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
         $totalStudents = Student::count();

        return view("home", ['total' => $totalStudents]);

    }
}