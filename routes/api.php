<?php
Route::get('/test', function () {
    $informationRepository = new \App\Repositories\InformationRepository(new \App\Models\Information());
    // dd($informationRepository->permissionToAddInformation());
    return $informationRepository->getSumParticipation();
});


$this->post('register', 'UserController@register');
$this->post('login', 'UserController@login');

Route::group(['namespace' => 'API'/*, 'middleware' => 'auth:api'*/], function () {
    $this->resource('information', 'InformationController');
});
