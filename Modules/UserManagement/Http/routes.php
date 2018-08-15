<?php

Route::group(['middleware' => 'web', 'prefix' => 'usermanagement', 'namespace' => 'Modules\UserManagement\Http\Controllers'], function()
{
    Route::get('/', 'UserManagementController@index');
});
