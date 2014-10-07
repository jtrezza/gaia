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
    	<p class="text-left before-posts" style="margin-bottom:2.5em;">
    		<span class="gris">Publicaciones</span>
    		<span class="destacado">{{$posts_count}}</span>
    		<span class="gris">Siguendo</span>
    		<a class="destacado" href="<?php echo url('users/following',$user->username) ?>">{{$following_count}}</a>
    		<span class="gris">Seguidores</span>
    		<a class="destacado" href="<?php echo url('users/followed',$user->username) ?>">{{$followed_count}}</a>
    		<a class="btn btn-default" style="float:right;" href="<?php echo url('users/'.$action,$user->username) ?>">{{$text}}</a>
    	</p>
    	<?php $posts = Post::with('user')->where('user_id','=',$user->id)->orderBy('created_at', 'desc')->take(15)->get(); ?>
    	@foreach ($posts as $p)
    		@include('posts/post_timeline', array('post'=>$p))
    	@endforeach
  	</div>
</div>
@stop