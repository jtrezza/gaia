@extends('layout')
@section('title') Actualizaciones @stop

@section('content')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#menu_inicio').addClass('active');
		});		
	</script>
	<div class="row zero-all">
	    <div class="col-md-6 col-md-offset-3 text-center" id="contenedor">
	    	<h3 class="text-left gris">Publicaciones</h3>
	    	<?php $posts = Post::timeline(Auth::user()); ?>
	    	
	    	@foreach ($posts as $p)
	    		@include('posts.post', array('p'=>$p))
	    	@endforeach
	  	</div>
    </div>
<input type="hidden" id="hdd_usuario_id" value="{{Auth::user()->id}}"/>
@stop