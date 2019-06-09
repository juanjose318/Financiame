@extends('layout')
@section('title','Dashboard')
@section('content')



<h1>{{ Auth::user()->name  }}</h1> 
<h2>{{ Auth::user()->credits }} Credits </h2>

<div class="row">
    <table class="table">
        <thead>
            <th>Project Title</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($projects as $project )

            <tr>
                <td><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></td>
                <td>
                    <a href=""></a>
                    <a href="/projects/{{ $project->id }}/edit">
                        <ion-icon name="create"></ion-icon>
                    </a>

                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

</div>
<div class="row">
    <a href="/projects/create" class="btn btn-primary">Create Project</a>
</div>

@endsection