<?php

$this->post('register', 'UserController@register');
$this->post('login', 'UserController@login');

Route::group(['namespace' => 'API'/*, 'middleware' => 'auth:api'*/], function () {
    $this->resource('information', 'InformationController');
});
