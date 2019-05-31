@extends('layout')

@section('content')

<div>
<h1 class="title"> {{ $project->title }} </h1>

<p> {{ $project->content }} </p>
</div>

<p><a href="/projects/{{ $project->id }}/edit">Edit</a></p>
@endsection