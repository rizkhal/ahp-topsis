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
            $data[$row->id]['id']   = $row->name;
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
            $data[$row->id]['id']   = $row->name;
            $data[$row->id]['text'] = $row->name;
        }

        return response()->json([
            'results' => array_values($data),
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CalculateDataTable $dataTable, Student $student)
    {
        return $dataTable->render('backend::calculate.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Student $student): View
    {
        return view('backend::calculate.create', [
            'students' => $student,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalculateRequest $request, Calculate $model)
    {
        if ($model->calculate($request->data())) {
            notice('success', 'Data criteria dan alternative berhasil dihitung.');
            return redirect()->route('admin.calculate.index');
        }

        notice('success', 'Data criteria dan alternative berhasil dihitung.');
        return redirect()->back();
    }

    /**
     * Show the detail of the calculated matrix
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Calculate $model, $id)
    {
        $data      = $model->show($id);
        $result    = $data['data']->result;
        $candidate = $data['data']->candidate;

        $ranks = [];
        foreach ($candidate as $i => $value) {
            array_push($ranks, [$value, $result[$i]]);
        }

        array_multisort(array_map(function ($element) {
            return $element[1];
        }, $ranks), SORT_DESC, $ranks);

        return view('backend::calculate.show', [
            'ranks'       => $ranks,
            'result'      => $result,
            'candidate'   => $candidate,
            'eigen'       => $data['data']->eigen,
            'solution'    => $data['data']->solution,
            'distance'    => $data['data']->distance,
            'normalize'   => $data['data']->normalize,
            'alternative' => $data['data']->alternative,
        ]);
    }
}
