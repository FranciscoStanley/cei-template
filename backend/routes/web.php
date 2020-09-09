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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => '/', 'namespace' => 'Site'], function () {
    Route::post('cadastrar/curriculum', 'CurriculumController@store')->name('cadastrar.curriculum');
    Route::post('matricula', 'CurriculumController@index')->name('find.curriculum');
 });

Route::group(['prefix' => 'admin', 'namespace'=> 'Site'], function () {
    Route::get('curriculum', 'CurriculumController@curriculuns')->name('find.curriculum');
    Route::get('curriculum/{id}/aprovar', 'CurriculumController@aprovar')->name('aprova.curriculum');
    Route::get('curriculum/{id}/reprovar', 'CurriculumController@reprovar')->name('reprovar.curriculum');
});
Route::group(['prefix' => 'admin'], function () {

    Voyager::routes();
});
