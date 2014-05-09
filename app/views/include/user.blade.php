<div class="row post-box">
	<div class="col-md-2 text-center">
		<img class="profile_picture_small img-rounded" src="{{url('uploads',$user->profile_picture)}}">
	</div>
	<div class="col-md-10 text-left texto-post">
		<b><a href="{{url("profile/$user->username")}}">{{ $user->fullname }}</a></b>
		&nbsp;<span class="gris">@<?php echo $user->username ?></span>
		<p>{{ $user->bio }}<a class="btn btn-default" style="float:right" href="{{url('profile',$user->username) }}">Ver perfil</a>	</p>

	</div>
</div>