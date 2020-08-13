<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use App\Models\Calculate;
use Illuminate\View\View;

class CalculateController extends Controller
{
    public function create(): View
    {
        return view('backend::calculate.create');
    }

    public function store(CalculateRequest $request, Calculate $model)
    {
        if ($model->calculate($request->data())) {
            dd('true');
        }

        dd('false');
    }
}
