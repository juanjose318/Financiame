@extends('layout')

@section('title','Users')

@section('content')

<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="/admin/users/{{ $user->id }}/projects" >{{ $user->name }}</a></td> 
                <td>
        
                <a href="{{ route('delete-user', ['id' => $user->id]) }}"><ion-icon name="trash"></ion-icon></a> 
                <a href="{{ route('admin-edit-user' , ['id'=> $user->id]) }}" ><ion-icon name="create"></ion-icon></a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection