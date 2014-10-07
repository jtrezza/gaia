<div class="col-md-4 text-center">
  <img class="img-circle profile_picture" src="{{asset('uploads/'.$photo)}}">
  <h2>{{$username}}</h2>
  <p>{{$text}}</p>
  <p><a class="btn btn-default" href="{{url('profile/'.$username)}}" role="button">Ver perfil &raquo;</a></p>
</div>