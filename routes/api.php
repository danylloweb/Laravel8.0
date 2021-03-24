<?php


Route::group(['middleware' => ['auth:api','cors']], function () {
    Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);
});
