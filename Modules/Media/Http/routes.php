<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Media\Http\Controllers'], function() {
// MediaManager
    ctf0\MediaManager\MediaRoutes::routes();
});