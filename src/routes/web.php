<?php 

use dolar\ActivityLog\Http\Controllers\LogtrackerController;

Route::group(['prefix' => 'api/audit-panel-data'], function () {
    
    /*************Default Logs API******************/
    Route::get('/', '\dolar\ActivityLog\Http\Controllers\LogtrackerController@logApidata');

    /**************Only for MongoDB**************** */
    Route::get('/log-synchronous', '\dolar\ActivityLog\Http\Controllers\LogtrackerController@getUnsynchronousData');
    Route::post('/log-synchronous', '\dolar\ActivityLog\Http\Controllers\LogtrackerController@synchronousProcess');
});