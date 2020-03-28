<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('feedback/index', 'FeedbackController@index')->name('Retrieve');
Route::get('feedback/{id}/find', 'FeedbackController@show')->name('Find');
Route::put('feedback/store', 'FeedbackController@store')->name('Create');
Route::delete('feedback/{id}/destroy', 'FeedbackController@destroy')->name('Delete');
Route::post('feedback/update', 'FeedbackController@update')->name('Update');