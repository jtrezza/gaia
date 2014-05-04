<?php

class AuthController extends BaseController
{
	public function showLogin()
    {
        // Verificamos que el usuario no esté autenticado
        if (Auth::check())
        {
            return Redirect::to('/timeline');
        }
        return View::make('login');
    }

    public function postLogin()
    {
        // Guardamos en un arreglo los datos del usuario.
        $userdata = array(
            'username' => Input::get('username'),
            'password'=> Input::get('password')
        );
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        if(Auth::attempt($userdata, Input::get('rememberme', 0)))
        {
            // De ser datos válidos nos mandara a la bienvenida
            return Redirect::to('/timeline');
        }
        // En caso de que la autenticación haya fallado manda un mensaje al formulario de login y también regresamos los valores enviados con withInput().
        return Redirect::to('login')
                    ->with('mensaje_error', 'Tus datos son incorrectos')
                    ->withInput();
    }

    public function logOut()
    {
        Auth::logout();
        return Redirect::to('/');
    }
}