<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/students', 'StudentController@getAllStudents');
Route::post('/api/students/add', 'StudentController@addStudent');
Route::post('/api/students/update', 'StudentController@updateStudent');
Route::post('/api/students/delete', 'StudentController@deleteStudent');

Route::get('/teachers', 'TeacherController@getAllTeachers');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*Route::group(['middleware' => ['web']], function () {
    
});*/
