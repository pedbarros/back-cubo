<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'API'], function () {
    $this->resource('information', 'InformationController');
});




$this->get('/test', function(){
    $information = \App\Models\Information::create(['firstName' => 'Pedro', 'lastName' => 'Barros', 'participation' => '10%']);// INSERT
    dd($information);
});

$this->middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
