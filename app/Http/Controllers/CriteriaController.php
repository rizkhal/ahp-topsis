<?php

namespace App\Http\Controllers;

use App\DataTables\CriteriaDataTable;
use App\Http\Requests\CriteriaRequest;
use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CriteriaDataTable $dataTable)
    {
        return $dataTable->render('backend::criteria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend::criteria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CriteriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriteriaRequest $request)
    {
        if ($request->ajax()) {
            if (Criteria::create($request->data())) {
                return response()->json([
                    'title'   => 'Berhasil!',
                    'message' => 'Data criteria berhasil ditambahkan.',
                ], 200);
            } else {
                return response()->json([
                    'title'   => 'Gagal!',
                    'message' => 'Terjadi kesalahan, gagal menambah data alternative.',
                ], 500);
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
            if ($cr = Criteria::find($id)) {
                $cr->delete();

                return response()->json([
                    'title'   => 'Berhasil!',
                    'message' => 'Data criteria berhasil dihapus.',
                ], 200);
            } else {
                return response()->json([
                    'title'   => 'Gagal!',
                    'message' => 'Terjadi kesalahan, gagal menghapus data criteria.',
                ], 500);
            }
        }
    }
}
