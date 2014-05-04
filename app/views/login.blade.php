@extends('layout')

@section('title') Log in @stop

@section('content')

<div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <p>&nbsp;</p>
          <h1>Log in</h1>
          <p>&nbsp;</p>
          {{ Form::open(array('url' => '/login')) }}

            <div class="form-group">
              <label for="user">Username</label>
              {{ Form::text('username', null, array('placeholder'=>'Username', 'class' => 'form-control', 'maxlength'=>'50', 'id'=>'user')) }}
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control', 'id'=>'password')) }}
            </div>
            <div class="form-group">
            	<label for="rememberme">Remember password</label>
            	<input type="checkbox" name="rememberme" id="rememberme" />
            </div>	
            {{ Form::button('Sing in', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
          {{ Form::close() }}
        </div>
      </div>      
    </div>
    <p>&nbsp;</p>
@stop