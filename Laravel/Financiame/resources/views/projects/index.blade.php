@extends('layout')

@section('title')
    Explore Projects
@endsection

@section('content')
<h1>Explore projects</h1>


@foreach($projects as $project)
<div>
    <a href="/projects/{{ $project->id }}"><h1>{{ $project->title }}</h1></a>
    <p>{{  $project->intro }}</p>
</div>

@endforeach


{{ $projects->links() }}


@endsection