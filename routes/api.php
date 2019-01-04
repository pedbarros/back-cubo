<?php
$this->post('register', 'UserController@register');
$this->post('login', 'UserController@login');

$this->group(['namespace' => 'API', 'middleware' => 'auth:api'], function () {
    $this->resource('information', 'InformationController');
});
