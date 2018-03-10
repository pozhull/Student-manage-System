<?php

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

Route::get('welcome', function () {
    return view('welcome');
});

/*登录页面*/
Route::any('/', ['uses' => 'LoginController@index']);
Route::any('login/index', ['uses' => 'LoginController@index']);
Route::any('login/verifyCode', ['uses' => 'LoginController@verifyCode']);
Route::any('login/resetPwd', ['uses' => 'LoginController@resetPwd']);
Route::any('login/modifyPwd', ['uses' => 'LoginController@modifyPwd']);

/*班级管理*/
Route::any('class/index', ['uses' => 'ClassController@index']);
Route::any('class/deleteClass', ['uses' => 'ClassController@deleteClass']);
Route::any('class/modifyClass', ['uses' => 'ClassController@modifyClass']);
Route::any('class/deleteStudent', ['uses' => 'ClassController@deleteStudent']);
Route::any('class/detailClass', ['uses' => 'ClassController@createClass']);
Route::any('class/createClass', ['uses' => 'ClassController@createClass']);
Route::any('class/createStudent', ['uses' => 'ClassController@createStudent']);
Route::any('class/modifyStudent', ['uses' => 'ClassController@modifyStudent']);

/*课程管理*/
Route::any('course/index', ['uses' => 'CourseController@index']);
Route::any('course/deleteCourse', ['uses' => 'CourseController@deleteCourse']);
Route::any('course/createCourse', ['uses' => 'CourseController@createCourse']);
Route::any('course/modifyCourse', ['uses' => 'CourseController@modifyCourse']);

/*账户管理*/
Route::any('account/index', ['uses' => 'AccountController@index']);
Route::any('account/deleteAccount', ['uses' => 'AccountController@deleteAccount']);
Route::any('account/createTeacher', ['uses' => 'AccountController@createTeacher']);
Route::any('account/getSingleTea', ['uses' => 'AccountController@getSingleTea']);
Route::any('account/modifyTeacher', ['uses' => 'AccountController@modifyTeacher']);

