<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CalculateController extends Controller
{
    /**
     * Calculate
     *
     * @return View
     */
    public function calculate(): View
    {
        return view("backend::implements.index");
    }
}
