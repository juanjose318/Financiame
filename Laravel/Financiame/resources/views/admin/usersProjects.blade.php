@extends('layout')

@section('title','User Projects')

@section('content')

<div class="row">

<h1>{{ $user -> name}}</h1>
</div>
<div class="row">
<table class="table">
        <thead>
            <tr>
                <th>Project Title</th>
                <th>Project Intro</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach($user->projects as $project)
            <tr>
                <td>
                    <a href="/projects/{{ $project->id }}">{{ $project->title }}</a>
                </td>
                <td>
                   {{ $project->intro }}
                </td> 
                <td>
                 <a href="{{ route('admin-delete-user-project', ['id' => $project->id]) }}"><ion-icon name="trash"></ion-icon></a>
                 <a href="{{ route('admin-edit-user-project', ['id'=> $project->id ]) }}"><ion-icon name="create"></ion-icon></a>
                </td>
            </tr>
            @endforeach
        </tbody>
</table>
</div>


@endsection