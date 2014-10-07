@extends('layout')

@section('content')
<!-- Jumbotron -->
    <div class="jumbotron">
      <div class="container">
        <h1>Bienvenido a Gaia!</h1>
        <p>Gaia es una red de microblogging creada como proyecto de ejemplo usando el framework PHP Laravel.</p>
        <p><a class="btn btn-primary btn-lg" role="button" href="{{route('users.create')}}">Registrarse &raquo;</a></p>
      </div>
    </div>    
    <div class="container">
      <!-- Subtítulo -->
      <div class="row">
        <div class="col-md-4">
          <h2>¿Quién está en Gaia?<br/> <small>Últimas publicaciones...</small> </h2>
        </div>
      </div>
    </div>
    <p>&nbsp;</p>
    <div class="container">
      <!-- Últimas publicaciones -->
      <div class="row">
      @foreach($posts as $post)
        @include('posts/post_index', array('username'=>$post->user->username, 'text'=>$post->text, 'photo'=>$post->user->profile_picture))
      @endforeach
      </div>
    </container>
@stop