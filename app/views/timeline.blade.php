@extends('layout')
@section('title') Actualizaciones @stop
@section('head')
<script src="{{asset('assets/js/templates.js')}}"></script>
@stop
@section('content')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#menu_inicio').addClass('active');
		});		
	</script>
	<div class="row zero-all">
	    <div class="col-md-6 col-md-offset-3 text-center" id="contenedor">
	    	<h3 class="text-left gris before-posts">Publicaciones</h3>
	    	<?php 
	    		$posts = Post::timeline(Auth::user());
	    	?>
	    	@foreach ($posts as $p)
	    		@include('posts.post_timeline', array('p'=>$p))
	    	@endforeach
	  	</div>
    </div>
<?php
	$id_ultimo = isset($posts[0]) ? $posts[0]->id : 0;
?>
<input type="hidden" id="hdd_ultimo_post" value="{{$id_ultimo}}"/>
@stop