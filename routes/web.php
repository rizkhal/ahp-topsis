<?php

use App\Http\Controllers\CalculateController;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware("auth")->as("admin.")->group(function () {
    Route::prefix("calculate")->as("calculate.")->group(function () {
        Route::get("/", [CalculateController::class, 'calculate'])->name("calculate");
    });
});
