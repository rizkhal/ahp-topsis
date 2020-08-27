<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use App\Models\Calculate;
use App\Models\Student;
use Illuminate\View\View;

class CalculateController extends Controller
{
    public function create(Student $student): View
    {
        return view('backend::calculate.create', [
            'students' => $student->all(),
        ]);
    }

    public function store(CalculateRequest $request, Calculate $model)
    {
        dd($request->data());
        if ($model->calculate($request->data())) {
            dd('true');
        }

        dd('false');
    }
}
