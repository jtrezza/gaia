<?php

class UserController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = new User;
		return View::make('users/form')->with('user', $user);
	}

	public function index()
	{
		return Redirect::to('/');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$filename = 'no_image.jpg';

		if (Input::hasFile('profile_picture'))
		{
			$destinationPath = 'uploads';
		    $file = Input::file('profile_picture');
			$name = sha1($file->getClientOriginalName()).'_'.sha1(microtime());
			$filename = $name.'.'.$file->getClientOriginalExtension();
			$upload_success = Input::file('profile_picture')->move($destinationPath, $filename);
		}
		
		// Creamos un nuevo objeto para nuestro nuevo usuario
        $user = new User;
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($user->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $user->fill($data);
            $user->profile_picture = $filename;
            // Guardamos el usuario
            $user->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            Return Redirect::to('login');
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('users.create')->withInput()->withErrors($user->errors);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function search()
	{
		$busqueda = Input::get('busqueda');
		return View::make('search', array('busqueda'=>$busqueda));
	}

	public function profile($username)
	{
		$texto = 'Seguir';
		$action = 'follow';
        
        if(Auth::user()){
            if(Auth::user()->isFollowingByUsername($username)){
    			$texto = 'Dejar de seguir';
    			$action = 'unfollow';
    		}else if (Auth::user()->username == $username){
    			$texto = 'Editar perfil';
    			$action = 'edit_profile';
    		}
        }
		
		$user = User::where('username', $username)->first();
        if(!$user){
        	App::abort(404);
        }
        $following_count = count($user->followingArray);
        $followed_count = count($user->followedArray);
        $posts_count = Post::where('user_id', $user->id)->count();
		
		return View::make('users.profile', array('username'=>$username, 'text'=>$texto, 'action'=>$action, 'following_count' => $following_count, 'followed_count' => $followed_count, 'posts_count'=>$posts_count));
	}
	
	public function follow($username)
	{
	    if(!Auth::user()->isFollowingByUsername($username) && Auth::user()->username != $username){
	        Auth::user()->follow($username);
	        $user = User::where('username', $username)->first();
	        if($user){
	            $user->be_followed(Auth::user());
	        }
			return Redirect::to('profile/'.$username);
		}else{
		    return Redirect::to('profile/'.$username);
		}
	}
	
	public function unfollow($username)
	{
	    if(Auth::user()->isFollowingByUsername($username)){
	        Auth::user()->unfollow($username);
	        
	        $user = User::where('username', $username)->first();
	        if($user){
	            $user->be_unfollowed(Auth::user());
	        }
			return Redirect::to('profile/'.$username);
		}else{
		    return Redirect::to('profile/'.$username);
		}
	}
	
	public function following($username)
	{
        $user = User::where('username', $username)->first();
        if($user){
            $following = User::whereIn('id', $user->followingArray)->get();
            return View::make('users/following', array('following'=>$following));
        }else{
            App::abort(404);
        }
	}
	
	public function followed($username)
	{
        $user = User::where('username', $username)->first();
        if($user){
            $followed = User::whereIn('id', $user->followedArray)->get();
            return View::make('users/followed', array('followed'=>$followed));
        }else{
            App::abort(404);
        }
	}
}