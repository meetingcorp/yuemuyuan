<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'client'], function(){
    Route::get('/test', function(){
        dd(123);
    });
});

// Route::get('/tests', function(){
//     dd(1234);
// });