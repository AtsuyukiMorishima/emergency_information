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

Route::get('', 'EmergencyEventController@index')->name('event.index');
Route::get('{id}', 'EmergencyEventController@show')->where('id', '[0-9]+')->name('event.show');
Route::view('about', 'event.about')->name('event.about');
Route::POST('{id}', 'EmergencyEventController@show')->where('id', '[0-9]+')->name('event.show');

Route::get('edit', 'EmergencyEventController@editlist')->name('event.edit');
Route::delete('edit/todo/{id}', 'DbController@deleteTodoById');
Route::POST('edit', 'DbController@updateTodoById');
Route::POST('edit/create', 'DbController@create');

Route::get('urledit/{ee_id}', 'EmergencyEventController@urledit')->name('event.urledit');
Route::delete('urledit/todo/{id}', 'SiteUrlController@deleteTodoById');
Route::POST('urledit', 'SiteUrlController@updateTodoById');
Route::POST('urledit/create', 'SiteUrlController@create');