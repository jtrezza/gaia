<div class="row post-box">
	<div class="col-md-2 text-center">
		<img class="profile_picture_small img-rounded" src="{{url('uploads',$p->user->profile_picture)}}">
	</div>
	<div class="col-md-10 text-left texto-post">
		<a href="{{url('profile',$p->user->username)}}"><b>{{$p->user->fullname}}</b></a>
		&nbsp;<span class="gris">&#64;{{$p->user->username}}</span>
		&nbsp;<span class="gris">{{$p->ago}}</span>
		<p>{{$p->text}}</p>
	</div>
	<p class="text-right" style="padding-right:5em;">
		<span style="cursor:pointer;" class="glyphicon glyphicon-refresh" title="Repost">&nbsp;</span>
		<span style="cursor:pointer;" class="glyphicon glyphicon-star-empty" title="Favorito">&nbsp;</span>
	</p>
</div>