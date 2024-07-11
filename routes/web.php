<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperatorWorkController;

Route::get('/', function () {
    return view('filter');
});

Route::group(['prefix'=>'data'], function(){
    Route::controller(OperatorWorkController::class)->group(function(){
        Route::get('operator-work','index');
        Route::get('list-filters','list_filter');
    });
});
