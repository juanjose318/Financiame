@extends('layout')

@section('title')
    News
@endsection

@section('content')
<h1>What's new?</h1>

@foreach ($posts as $post)
<article>
    <h1>{{$post->title}}</h1>
    <p>{{$post->content}}</p>
</article>
@endforeach

<ul>
@foreach ($posts as $post)

    <li><a href="/posts/{{ $post->id }}">{{$post->title}}</a></li>

@endforeach
</ul>
@endsection

