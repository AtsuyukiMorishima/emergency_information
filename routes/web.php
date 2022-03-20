<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('', 'EmergencyEventController@index')->name('event.index');

    // user manage
    Route::get('useredit', 'UserController@index')->name('user.index');
    Route::POST('useredit', 'UserController@updateTodoById')->name('user.update');
    Route::delete('useredit', 'UserController@destroy')->name('user.remove');

    // event manage
    Route::delete('edit/todo/{id}', 'DbController@deleteTodoById');
    Route::POST('edit', 'DbController@updateTodoById');
    Route::POST('edit/create', 'DbController@create');
    Route::POST('edit/import', 'DbController@import');
    Route::POST('edit/uploadcsv', 'FileController@uploadEventByCsv');
    Route::POST('edit/deletecsv', 'FileController@deleteEventCsv');


    // event url manage
    Route::delete('urledit/todo/{id}', 'SiteUrlController@deleteTodoById');
    Route::POST('urledit', 'SiteUrlController@updateTodoById');
    Route::POST('urledit/create', 'SiteUrlController@create');
    Route::POST('urledit/import', 'SiteUrlController@import');
    Route::POST('urledit/uploadcsv', 'FileController@uploadEventUrlByCsv');
    Route::POST('urledit/deletecsv', 'FileController@deleteEventUrlCsv');

    // vote
    Route::post('/vote', 'EmergencyEventController@favorVote')->name('favorVote');

    // logout
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
 });

Route::get('{id}', 'EmergencyEventController@show')->where('id', '[0-9]+')->name('event.show');
Route::view('about', 'event.about')->name('event.about');
Route::POST('{id}', 'EmergencyEventController@show')->where('id', '[0-9]+');


Route::get('edit', 'EmergencyEventController@editlist')->name('event.edit');

Route::get('urledit/{ee_id}', 'EmergencyEventController@urledit')->name('event.urledit');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');