<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('stub')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('show', 'Stub\UserController@show');
        Route::post('update', 'Stub\UserController@update');
        Route::post('upload_image', 'Stub\UserController@uploadImage');
        Route::post('delete_image', 'Stub\UserController@deleteImage');
        Route::get('properties', 'Stub\UserController@properties');
        Route::get('search', 'Stub\UserController@search');
        Route::get('examplelist', 'Stub\UserController@examplelist');
        Route::post('evaluationupdate', 'Stub\UserController@evaluationupdate');
        Route::get('painterprofileimage', 'Stub\UserController@painterprofileimage');
        Route::get('painterimages', 'Stub\UserController@painterimages');
        Route::get('painterimageurl', 'Stub\UserController@painterimageurl');
        Route::get('exampleimageurl', 'Stub\UserController@exampleimageurl');
        Route::get('getevaluation', 'Stub\UserController@getevaluation');
        Route::get('getevaluationcount', 'Stub\UserController@getevaluationcount');
        Route::get('favorite', 'Stub\UserController@favorite');
        Route::get('addfavorite', 'Stub\UserController@addfavorite');
        Route::get('deletefavorite', 'Stub\UserController@deletefavorite');
        Route::post('inquiry', 'Stub\UserController@inquiry');
        Route::post('update_password', 'Stub\UserController@updatePassword');
        Route::post('withdraw', 'Stub\UserController@withdraw');
        Route::get('getcolumn', 'Stub\UserController@getcolumn');
    });

    Route::prefix('property')->group(function () {
        Route::post('store', 'Stub\PropertyController@store');
        Route::post('update/{id}', 'Stub\PropertyController@update');
        Route::post('destroy/{id}', 'Stub\PropertyController@destroy');
    });

    Route::prefix('painter')->group(function () {
        Route::get('show', 'Stub\PainterController@show');
        Route::post('update', 'Stub\PainterController@update');
        Route::post('upload_image', 'Stub\PainterController@uploadImage');
        Route::post('delete_image', 'Stub\PainterController@deleteImage');
        Route::post('store', 'Stub\PainterController@store');
        Route::get('images', 'Stub\PainterController@images');
        Route::get('imageurl', 'Stub\PainterController@imageurl');
        Route::post('exampleentry', 'Stub\PainterController@exampleentry');
        Route::post('inquiry', 'Stub\PainterController@inquiry');
        Route::post('update_password', 'Stub\PainterController@updatePassword');
        Route::post('withdraw', 'Stub\PainterController@withdraw');
        Route::post('columnstore', 'Stub\PainterController@columnstore');
        Route::get('getpainterinfo', 'Stub\PainterController@getpainterinfo');
        Route::get('getexampleentrylink', 'Stub\PainterController@getexampleentrylink');
        Route::get('getcolumnlink', 'Stub\PainterController@getcolumnlink');
        Route::get('examplelist', 'Stub\PainterController@examplelist');
        Route::post('exampleupload', 'Stub\PainterController@exampleupload');
        Route::get('deleteexample', 'Stub\PainterController@deleteexample');
        Route::get('getcolumn', 'Stub\PainterController@getcolumn');
        Route::post('columnupload', 'Stub\PainterController@columnupload');
        Route::get('deletecolumn', 'Stub\PainterController@deletecolumn');
        Route::get('getevaluation', 'Stub\UserController@getevaluation');
    });

});

Route::prefix('v1')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('show', 'V1\UserController@show');
        Route::post('update', 'V1\UserController@update');
        Route::post('upload_image', 'V1\UserController@uploadImage');
        Route::post('delete_image', 'V1\UserController@deleteImage');
        Route::get('properties', 'V1\UserController@properties');
        Route::get('search', 'V1\UserController@search');
        Route::get('examplelist', 'V1\UserController@examplelist');
        Route::post('evaluationupdate', 'V1\UserController@evaluationupdate');
        Route::get('painterprofileimage', 'V1\UserController@painterprofileimage');
        Route::get('painterimages', 'V1\UserController@painterimages');
        Route::get('painterimageurl', 'V1\UserController@painterimageurl');
        Route::get('exampleimageurl', 'V1\UserController@exampleimageurl');
        Route::get('getevaluation', 'V1\UserController@getevaluation');
        Route::get('getevaluationcount', 'V1\UserController@getevaluationcount');
        Route::get('favorite', 'V1\UserController@favorite');
        Route::get('addfavorite', 'V1\UserController@addfavorite');
        Route::get('deletefavorite', 'V1\UserController@deletefavorite');
        Route::post('inquiry', 'V1\UserController@inquiry');
        Route::post('update_password', 'V1\UserController@updatePassword');
        Route::post('withdraw', 'V1\UserController@withdraw');
        Route::get('getcolumn', 'V1\UserController@getcolumn');
    });

    Route::prefix('painter')->group(function () {
        Route::get('show', 'V1\PainterController@show');
        Route::post('update', 'V1\PainterController@update');
        Route::post('upload_image', 'V1\PainterController@uploadImage');

        Route::get('images', 'V1\PainterController@images');
        Route::get('imageurl', 'V1\PainterController@imageurl');
        Route::post('exampleentry', 'V1\PainterController@exampleentry');
        Route::post('inquiry', 'V1\PainterController@inquiry');
        Route::post('update_password', 'V1\PainterController@updatePassword');
        Route::post('withdraw', 'V1\PainterController@withdraw');
        Route::post('columnstore', 'V1\PainterController@columnstore');
        Route::get('getpainterinfo', 'V1\PainterController@getpainterinfo');
        Route::get('getexampleentrylink', 'V1\PainterController@getexampleentrylink');
        Route::get('getcolumnlink', 'V1\PainterController@getcolumnlink');
        Route::get('examplelist', 'V1\PainterController@examplelist');
        Route::post('exampleupload', 'V1\PainterController@exampleupload');
        Route::get('deleteexample', 'V1\PainterController@deleteexample');
        Route::get('getcolumn', 'V1\PainterController@getcolumn');
        Route::post('columnupload', 'V1\PainterController@columnupload');
        Route::get('deletecolumn', 'V1\PainterController@deletecolumn');
    });
});

Route::post('/message', 'MessageController@get')->name('message.get');
Route::put('/message', 'MessageController@store')->name('message.send');
Route::get('/pdf/{name}', 'MessageController@pdf')->name('message.pdf');
Route::get('/message/clear', 'MessageController@clear')->name('message.clear');

Route::match(['get', 'post', 'put'], 'estimate', 'WorkflowController@estimate');
Route::match(['get', 'post'], 'proposal', 'WorkflowController@proposal');
Route::get('/properties/{kbn}/{user_id}', 'WorkflowController@get_properties');
Route::get('/favorites/{user_id}', 'WorkflowController@get_favorites');
Route::get('/messages/{id}/{kbn}', 'WorkflowController@get_messages');

Route::get('/workflow/user', 'WorkflowController@workflow_u');
Route::get('/workflow/painter', 'WorkflowController@workflow_p');
Route::get('/negotiation/{id}', 'WorkflowController@negotiation');
Route::get('/contract/{id}', 'WorkflowController@contract');
Route::get('/finish/{id}', 'WorkflowController@finish');
Route::post('/complete', 'WorkflowController@complete');
