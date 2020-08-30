<?php

namespace App\Http\Controllers;

use App\DataTables\CalculateDataTable;
use App\Http\Requests\CalculateRequest;
use App\Models\Alternative;
use App\Models\Calculate;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalculateController extends Controller
{
    /**
     * Search the student where query from ajax request
     *
     * @param  Request $request
     * @param  Student $student
     * @return response
     */
    public function student(Request $request, Student $student)
    {
        $students = $student->searchByName($request->query());
        $data     = [];

        foreach ($students as $i => $row) {
            $data[$row->id]['id']   = $row->id;
            $data[$row->id]['text'] = $row->name;
        }

        return response()->json([
            'results' => array_values($data),
        ], 200);
    }

    /**
     * Search the alternative where query from ajax request
     *
     * @param  Request $request
     * @param  Alternative $student
     * @return response
     */
    public function alternative(Request $request, Alternative $alternative)
    {
        $alternatives = $alternative->searchByName($request->query());
        $data         = [];

        foreach ($alternatives as $i => $row) {
            $data[$row->id]['id']   = $row->id;
            $data[$row->id]['text'] = $row->name;
        }

        return response()->json([
            'results' => array_values($data),
        ], 200);
    }

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
        if ($model->calculate($request->data())) {
            notice('success', 'Data criteria dan alternative berhasil dihitung.');
            return redirect()->route('admin.calculate.index');
        }

        notice('success', 'Data criteria dan alternative berhasil dihitung.');
        return redirect()->back();
    }
}
