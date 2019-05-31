@extends('layout')

@section('content')

<div>
<h1 class="title">{{$post->title}}</h1>

<p> {{$post->content}} </p>
<div class="row">
@foreach($post->images as $image)
<div class="col-sm">
<img class="img-fluid" src="{{  $image->filepath . '/' . $image->filename}}" alt="{{ $post->title }}">
</div>

@endforeach
</div>
</div>

<p><a href="/posts/{{ $post->id }}/edit">Edit</a></p>
@endsection