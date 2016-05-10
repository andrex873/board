<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/v1'], function () {

    Route::resource('boards', 'BoardsController', ['except' => ['create', 'edit', 'update']]);
    Route::resource('boards.notes', 'NotesController', ['except' => ['create', 'edit']]);
    Route::put('boards/{boards}/notes/{notes}/add/votes', ['as' => 'api.v1.boards.notes.votes', 'uses' => 'NotesController@votes']);

});
