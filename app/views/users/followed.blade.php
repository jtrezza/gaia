@extends('layout')
@section('title') Seguido por... @stop

@section('content')	
	<div class="row zero-all">
	    <div class="col-md-6 col-md-offset-3 text-center" id="contenedor">
	    	<h3 class="text-left gris">Seguido por: </h3>
	    	@foreach ($followed as $u)
	    		@include('users/user_include', array('user'=>$u))
	    	@endforeach
	  	</div>
    </div>
@stop