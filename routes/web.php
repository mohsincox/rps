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
Route::get('/result/remove-one-subject/{id?}', 'ResultController@removeOneSubject');
Route::get('/result/clear-all-subjects', 'ResultController@clearAllSubjects');
Route::post('/result/save-cart', 'ResultController@saveCart');

Route::get('/result/show-result-form', 'ResultController@showResultForm');
Route::post('/result/show-result', 'ResultController@showResult');

Route::get('/result/show-result-fail-form', 'ResultController@showResultFailForm');
Route::post('/result/show-result-fail', 'ResultController@showResultFail');

Route::get('/result/print-form', 'ResultController@printForm');
Route::post('/result/print-show', 'ResultController@printShow');

Route::get('/result/student-name-show', 'ResultController@studentNameShow');
Route::resource('/result', 'ResultController');