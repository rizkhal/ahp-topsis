<?php

use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware("auth")->as("admin.")->group(function () {
    Route::resource('ahp', 'AhpController');
    Route::resource('criteria', 'CriteriaController')->except('show');
    Route::resource('alternative', 'AlternativeController')->except('show');
});
