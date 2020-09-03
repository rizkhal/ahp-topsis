<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Calculate;
use App\Models\Student;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Alternative $alternative, Calculate $calculate, Student $student)
    {
        return view('backend::dashboard.index', [
            'student'     => $student->count(),
            'calculate'   => $calculate->count(),
            'alternative' => $alternative->count(),
        ]);
    }
}
