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

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::get('dashboard', 'DashboardController@index');
Route::get('dashboard/regionales', 'DashboardController@regionales');
Route::get('categorias/', 'DashboardController@categorias');
Route::get('ver_desafio/{desafio}', 'DesafioController@ver_desafio');
Route::get('formulario/{categoria}', 'DesafioController@formulario');
Route::post('formulario/guardar', 'DesafioController@guardar');
Route::post('formulario/cargarImg', 'DesafioController@cargarImg');
Route::get('activate/{token}/{club}/{email}', 'LoginController@activate2');



Route::get('404', function(){
    abort(404);
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
