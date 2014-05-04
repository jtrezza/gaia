@extends('layout')
<?php
$user = User::where('username','=',$username)->first();
if(!$user){
	App::abort(404);
}


?>
@section('title') {{$user->fullname}} @stop
@section('content')
<div class="row zero-all">
	    <div class="col-md-6 col-md-offset-3 text-center" id="contenedor">
	    	<h1 class="text-center">{{$user->fullname}}</h1>
	    	<img  class="profile_picture img-rounded" src="{{url('uploads',$user->profile_picture)}}">
	    	<p><b class="gris">@<?php echo $user->username; ?></b></p>
	    	<p style="margin-top:10px;">{{$user->bio}}</p>
			<hr />
	    	<p class="text-left" style="margin-bottom:2.5em;">
	    		<span class="gris">Publicaciones</span>
	    		<span class="destacado">35</span>
	    		<span class="gris">Siguendo</span>
	    		<span class="destacado">125</span>
	    		<span class="gris">Seguidores</span>
	    		<span class="destacado">60</span>
	    		<button class="btn btn-default" style="float:right;" onclick="{{$action}}('{{$user->username}}');">{{$texto}}</button>
	    	</p>
	    	<?php $posts = Post::with('user')->where('user_id','=',$user->id)->orderBy('created_at', 'desc')->take(15)->get(); ?>
	    	@foreach ($posts as $p)
	    		@include('include/post', array('post'=>$p))
	    	@endforeach
	  	</div>
    </div>
@stop