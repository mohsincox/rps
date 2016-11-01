<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/test', 'TestController@index');
Route::resource('/class', 'ClassController');
Route::resource('/year', 'YearController');
Route::resource('/section', 'SectionController');
Route::resource('/student', 'StudentController');
Route::resource('/term', 'TermController');
Route::resource('/subject', 'SubjectController');
Route::post('/result/add-to-cart', 'ResultController@addToCart');
Route::get('/result/remove-list/{id?}', 'ResultController@removeList');
Route::get('/result/clear-all-lists', 'ResultController@clearAllLists');
Route::post('/result/save-cart', 'ResultController@saveCart');
Route::get('/result/show-result-form', 'ResultController@showResultForm');
Route::post('/result/show-result', 'ResultController@showResult');
Route::resource('/result', 'ResultController');