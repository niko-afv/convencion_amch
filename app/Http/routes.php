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
Route::get('categorias/{unidad}', 'DashboardController@categorias');
Route::get('ver_desafio/{unidad}/{desafio}', 'DashboardController@ver_desafio');
Route::get('formulario/{unidad}/{categoria}', 'DashboardController@formulario');
Route::post('formulario/guardar', 'DashboardController@guardar');
Route::post('formulario/cargarImg', 'DashboardController@cargarImg');
Route::get('activate/{token}/{club}/{email}', 'LoginController@activate2');


Route::get('404', function(){
    abort(404);
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
