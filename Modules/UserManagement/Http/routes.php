<?php

Route::group(['middleware' => 'web', 'prefix' => 'users', 'namespace' => 'Modules\UserManagement\Http\Controllers'], function()
{
    Route::get('/', 'UserManagementController@index');
});
