@extends('layout')

@section('content')

<div>
<h1 class="title">{{$post->title}}</h1>

<p> {{$post->content}} </p>
<div class="row">

<div class="col-sm">
<img class="img-fluid" src="{{ asset("/storage/posts/$post->image_path") }}">
<p> Published at : {{ $post->created_at }}</p>
</div>
</div>
</div>
@endsection