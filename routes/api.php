<?php

$this->get('/test', function () {
    $userObj = \App\User::find("5c2a0793aa47b91b224d9a55");
    $tokenStr = $userObj->createToken("5c2a0793aa47b91b224d9a55")->accessToken;
   return $tokenStr;
});


$this->post('register', 'UserController@register');
$this->post('login', 'UserController@login');

$this->group(['namespace' => 'API', 'middleware' => 'auth:api'], function () {
    $this->resource('information', 'InformationController');
});
