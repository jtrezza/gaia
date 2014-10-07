@extends('layout')
@section('title') Búsqueda @stop

@section('content')	
	<div class="row zero-all">
	    <div class="col-md-6 col-md-offset-3 text-center" id="contenedor">
	    	<h3 class="text-left gris">Búsqueda: {{$busqueda}}</h3>
	    	<?php $users = User::where('fullname','like',"%$busqueda%")->orWhere('username','like',"%$busqueda%")->take(15)->get(); ?>
	    	@foreach ($users as $u)
	    		@include('users/user_include', array('user'=>$u))
	    	@endforeach
	  	</div>
    </div>
@stop