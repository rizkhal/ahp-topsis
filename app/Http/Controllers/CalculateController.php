<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CalculateController extends Controller
{
    /**
     * Calculate
     *
     * @return View
     */
    public function index()
    {
        return view("backend::implements.index");
    }

    /**
     * Store
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }
}
