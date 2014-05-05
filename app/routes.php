<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

Route::resource('users', 'UserController');

// Nos mostrará el formulario de login.
Route::get('login', 'AuthController@showLogin');

// Validamos los datos de inicio de sesión.
Route::post('login', 'AuthController@postLogin');

// Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado.
Route::group(array('before' => 'auth'), function()
{
	Route::get('timeline', function()
	{
		return View::make('timeline');
	});
    //Cerrar sesión
    Route::get('logout', 'AuthController@logOut');
    //Publicar
    Route::post('posts', 'PostController@store');
    //Búsqueda de usuarios
    Route::post('users/search', 'UserController@search');
    
    Route::get('users/follow/{username}', 'UserController@follow');
    Route::get('users/unfollow/{username}', 'UserController@unfollow');
});

Route::get('profile/{username}', 'UserController@profile');