<?php

class PostController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$usuario = Input::get('usuario');
		$mensaje = Input::get('mensaje');



		$post = new Post();
		$post->user_id = $usuario;
		$post->text = $mensaje;
		$post->save();

		if($post->save()){
			return Response::json(array (
		        'success' => true,
		    ));
		}else{
			return Response::json(array (
		        'success' => false,
		    ));
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
    
    public function new_posts()
    {
        $last = Input::get('ultimo_post');
        $user_id = Input::get('user_id');
        $user = User::find($user_id);
        
        if($user){
            $coleccion = Post::timeline($user, $last);
            $nuevos  = $coleccion->toArray();
            
            return json_encode($nuevos);
        }else{
            return json_enconde(array());
        }
    }

}
