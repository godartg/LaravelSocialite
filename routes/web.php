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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas de autenticación con redes sociales
Route::get('login/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('login/{provider}/callback', 'SocialAuthController@handleProviderCallback');

//Rutas para API de GOOGLE DRIVE
Route::get('/api', 'GoogleDriveController@getFolders');
Route::get('/api/upload', 'GoogleDriveController@uploadFiles');
Route::post('/api/upload', 'GoogleDriveController@getFiles');
Route::get('/api', 'GoogleDriveController@getFiles');