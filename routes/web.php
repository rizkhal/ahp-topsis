<?php

use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware("auth")->as("admin.")->group(function () {
    Route::resource('calculate', CalculateController::class);
    Route::resource('students', StudentController::class)->except('show');
    Route::resource('alternatives', AlternativeController::class)->except('show');

    Route::prefix('json')->as('json.')->group(function () {
        Route::get('search-student', 'CalculateController@student')->name('student');
    });
});
