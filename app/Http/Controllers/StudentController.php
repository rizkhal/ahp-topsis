<?php

namespace App\Http\Controllers;

use App\DataTables\StudentDataTable;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StudentDataTable $dataTable)
    {
        return $dataTable->render('backend::students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend::students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request, Student $model)
    {
        if ($model->store($request->data())) {
            return redirect()->back();
        }

        dd('error');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $model, $id)
    {
        return view('backend::students.edit', [
            'student' => $model->findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $model, $id)
    {
        if ($model->edit($request->data(), $id)) {
            return redirect()->back();
        }

        dd('error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $model, $id)
    {
        if ($model->remove($id)) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Berhasil menghapus data',
            ], 200);
        }

        return response()->json([
            'status'  => 'failed',
            'message' => 'Terjadi kesalahan',
        ], 500);
    }
}
