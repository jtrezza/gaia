@extends('posts/base')
@section('username'){{ $post->user->username }}@stop
@section('ago'){{  $post->ago }}@stop
@section('text'){{ $post->text }}@stop