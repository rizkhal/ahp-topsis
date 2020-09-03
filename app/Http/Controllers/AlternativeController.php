<?php

namespace App\Http\Controllers;

use App\DataTables\AlternativeDataTable;
use App\Http\Requests\AlternativeRequest;
use App\Models\Alternative;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AlternativeDataTable $dataTable)
    {
        return $dataTable->render('backend::alternatives.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend::alternatives.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlternativeRequest $request, Alternative $model)
    {
        if ($model->store($request->data())) {
            notice('success', 'Berhasil menambah data alternative baru.');
            return redirect()->route('admin.alternatives.index');
        }

        notice('error', 'Maaf, terjadi kesalahan.');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternative $model, $id)
    {
        return view('backend::alternatives.edit', [
            'row' => $model->findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlternativeRequest $request, Alternative $model, $id)
    {
        if ($model->edit($request->data(), $id)) {
            notice('success', 'Berhasil mengubah data alternative.');
            return redirect()->route('admin.alternatives.index');
        }

        notice('error', 'Maaf, terjadi kesalahan.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternative $model, $id)
    {
        if ($model->remove($id)) {
            return response()->json([
                'type'    => 'success',
                'message' => 'Berhasil menghapus data',
            ], 200);
        }

        return response()->json([
            'type'    => 'error',
            'message' => 'Terjadi kesalahan',
        ], 500);
    }
}
