@extends('layout')

@section('title','News')
    

@section('content')

<h1>What's new?</h1>

@foreach ($posts as $post)
<div class="card mb-4 box-shadow">
                <img class="card-img-top"  alt="{{ $post->title }}" style="height: 250px; width:100%; display: block;" src='{{asset("/storage/posts/$post->image_path") }}'>
                <div class="card-header">
                    <h3><a href="/posts/{{ $post->id }}"> {{$post->title}}</a></h3>
                </div>
                <div class="card-body">
                  <p class="card-text">{{$post->intro}}</p>
                </div>
 </div>
@endforeach

<ul>
@foreach ($posts as $post)

    <li><a href="/posts/{{ $post->id }}">{{$post->title}}</a></li>

@endforeach
</ul>
@endsection

