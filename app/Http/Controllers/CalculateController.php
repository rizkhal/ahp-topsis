<?php

declare (strict_types = 1);

namespace App\Http\Controllers;

use App\DataTables\CalculateDataTable;
use App\Http\Requests\CalculateRequest;
use App\Models\Calculate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalculateController extends Controller
{
    /**
     * List all data using DataTable
     *
     * @param  CalculateDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse;
     */
    public function index(CalculateDataTable $dataTable)
    {
        return $dataTable->render("backend::implements.index");
    }

    /**
     * View the form
     *
     * @return View
     */
    public function create(): View
    {
        return view("backend::implements.create");
    }

    /**
     * Store the incoming request
     *
     * @param  CalculateRequest $request
     * @return Illuminate\Http\Response
     */
    public function store(CalculateRequest $request, Calculate $model)
    {
        if ($model->calculate($request->data())) {
            //
        }
    }
}
