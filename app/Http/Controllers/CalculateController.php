<?php

namespace App\Http\Controllers;

use App\DataTables\CalculateDataTable;
use App\Http\Requests\CalculateRequest;
use App\Models\Calculate;
use App\Models\Student;
use Illuminate\View\View;

class CalculateController extends Controller
{
    public function index(CalculateDataTable $dataTable, Student $student)
    {
        return $dataTable->render('backend::calculate.index');
    }

    public function create(Student $student): View
    {
        return view('backend::calculate.create', [
            'students' => $student,
        ]);
    }

    public function store(CalculateRequest $request, Calculate $model)
    {
        $data = $model->calculate($request->data());
        dd($data);
    }
}
