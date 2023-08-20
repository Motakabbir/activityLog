<?php 

use dolar\Activitylog\Http\Controllers\LogtrackerController;

Route::group(['prefix' => 'api/audit-panel-data'], function () {
    
    /*************Default Logs API******************/
    Route::get('/', '\dolar\Activitylog\Http\Controllers\LogtrackerController@logApidata');

    /**************Only for MongoDB**************** */
    Route::get('/log-synchronous', '\dolar\Activitylog\Http\Controllers\LogtrackerController@getUnsynchronousData');
    Route::post('/log-synchronous', '\dolar\Activitylog\Http\Controllers\LogtrackerController@synchronousProcess');
});