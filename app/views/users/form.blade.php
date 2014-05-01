@extends('layout')
<?php

    if ($user->exists):
        $form_data = array('route' => array('users.update', $user->id), 'method' => 'PATCH', 'files' => true);
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'users.store', 'method' => 'POST', 'files' => true);
        $action    = 'Crear';        
    endif;

?>
@section('title') ¡Únete! @stop

@section('content')
<div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <p>&nbsp;</p>
          <h1>Crear cuenta</h1>
          <p>&nbsp;</p>
          {{ Form::model($user,$form_data, array('role' => 'form')) }}

            <div class="form-group">
              <label for="user">Nombre de usuario</label>
              <div class="input-group">
                <span class="input-group-addon">@</span>
                {{ Form::text('username', null, array('placeholder' => 'Choose an username', 'class' => 'form-control', 'maxlength'=>'50', 'id'=>'user')) }}
              </div>
            </div>

            <div class="form-group">
              <label for="email">Correo electónico</label>
              {{ Form::text('email', null, array('placeholder' => 'Enter email', 'class' => 'form-control', 'maxlength'=>'120', 'id'=>'email')) }}
            </div>

            <div class="form-group">
              <label for="fullname">Full name</label>
              {{ Form::text('fullname', null, array('placeholder' => 'Full name', 'class' => 'form-control', 'maxlength'=>'255', 'id'=>'fullname')) }}
            </div>

            <div class="form-group">
              <label for="bio">Bio</label>
               {{ Form::text('bio', null, array('placeholder' => 'Describe you in 160 characters or less', 'class' => 'form-control', 'maxlength'=>'160', 'id'=>'bio')) }}
            </div>

            <div class="form-group">
              <label for="location">Location</label>
              {{ Form::text('location', null, array('placeholder' => 'Where do you live?', 'class' => 'form-control', 'maxlength'=>'120', 'id'=>'location')) }}
            </div>

            <div class="form-group">
              <label for="website">Website</label>
              {{ Form::text('website', null, array('placeholder' => 'Type here your website or blog url', 'class' => 'form-control', 'maxlength'=>'120', 'id'=>'website')) }}
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control', 'id'=>'password')) }}
            </div>

            <div class="form-group">
              <label for="password_confirmation">Password confirm</label>
              {{ Form::password('password_confirmation', array('placeholder' => 'Confirm your password', 'class' => 'form-control', 'id'=>'password_confirmation')) }}
            </div>

            <div class="form-group">
              <label for="profile_picture">Profile picture</label>
              {{Form::file('profile_picture',array('id'=>'profile_picture'));}}
              <p class="help-block">This photo will be used to idntify you on the social network.</p>
            </div>
            {{ Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
          {{ Form::close() }}
        </div>
      </div>      
    </div>
    <p>&nbsp;</p>
@stop
@include ('errors', array('errors' => $errors)) 