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
        return $dataTable->render('backend::alternative.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlternativeRequest $request)
    {
        if ($request->ajax()) {
            if (Alternative::create($request->data())) {
                return response()->json([
                    'title'   => 'Berhasil!',
                    'message' => 'Data alternative berhasil ditambahkan.',
                ], 200);
            } else {
                return response()->json([
                    'title'   => 'Gagal!',
                    'message' => 'Terjadi kesalahan, gagal menambah data alternative.',
                ], 200);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            if ($alt = Alternative::find($id)) {
                $alt->delete();
                return response()->json([
                    'title'   => 'Berhasil!',
                    'message' => 'Data alternative berhasil dihapus.',
                ], 200);
            } else {
                return response()->json([
                    'title'   => 'Gagal!',
                    'message' => 'Terjadi kesalahan, gagal menghapus data alternative.',
                ], 500);
            }
        }
    }
}
