@extends('layout')

@section('content')
<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Bienvenido a Gaia!</h1>
        <p>Gaia es una red de microblogging creada como proyecto de ejemplo para aprender a manejar el framework PHP Laravel.</p>
        <p><a class="btn btn-primary btn-lg" role="button" href="{{route('users.create')}}">Registrarse &raquo;</a></p>
      </div>
    </div>    
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Who is in Gaia? <br/> <small>Last posts...</small> </h2>
        </div>
      </div>
    </div>
    <p>&nbsp;</p>
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4 text-center">
          <img class="img-circle profile_picture" src="profile_images/jtrezza.jpeg">
          <h2>jtrezza</h2>
          <p>Si no tengo canción favorita, mucho menos libro favorito. </p>
          <p><a class="btn btn-default" href="#" role="button">View profile &raquo;</a></p>
        </div>
        <div class="col-md-4 text-center">
          <img class="img-circle profile_picture" src="profile_images/gowend132.jpeg">
          <h2>gowend132</h2>
          <p>Una excelente sensación que me gustaría tener sería vivir cerca de mi trabajo. </p>
          <p><a class="btn btn-default" href="#" role="button">View profile &raquo;</a></p>
       </div>
        <div class="col-md-4 text-center">
          <img class="img-circle profile_picture" src="profile_images/0717kathy.jpeg">
          <h2>0717kathy</h2>
          <p>Que mejor felicidad que haber comprado el celular que quería después de tantos sacrificios :3</p>
          <p><a class="btn btn-default" href="#" role="button">View profile &raquo;</a></p>
        </div>
      </div>
    </container>
@stop