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
    if(!Auth::user()){
        //DB::select(DB::raw("Aqui va la query"));
        //$posts = Post::with('user')->groupBy('user_id')->orderBy('id','desc')->take(3)->get();
        //
        $posts = Post::with('user')
        ->from(DB::raw('(SELECT * FROM posts ORDER BY id desc)sub'))
			->groupBy('user_id')->orderBy('created_at', 'desc')->take(3)->get();
        //die(print_r($posts));
        return View::make('index', array('posts'=>$posts));
	}else{
	    return Redirect::to('timeline');
	}
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
    Route::get('new_posts', 'PostController@new_posts');
    //Búsqueda de usuarios
    Route::post('users/search', 'UserController@search');
    
    Route::get('users/follow/{username}', 'UserController@follow');
    Route::get('users/unfollow/{username}', 'UserController@unfollow');
    Route::get('users/following/{username}', 'UserController@following');
    Route::get('users/followed/{username}', 'UserController@followed');
    
    Route::get('templates/load', 'TemplateController@load');
});

Route::get('profile/{username}', 'UserController@profile');