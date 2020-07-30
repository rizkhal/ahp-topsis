<?php

declare (strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use App\Models\Calculate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalculateController extends Controller
{
    /**
     * View the form
     *
     * @return View
     */
    public function index(): View
    {
        return view("backend::implements.index");
    }

    /**
     * Store the incoming request matrix
     *
     * @param  CalculateRequest $request
     * @return Illuminate\Http\Response
     */
    public function store(CalculateRequest $request, Calculate $model)
    {
        if ($model->calculate($request->data())) {
            return redirect()->back();
        } else {
            //
        }
    }
}
