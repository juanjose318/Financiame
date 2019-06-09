@extends('layout')

@section('title','Edit User')

@section('content')

<form action="{{ route('admin-update-user', $user) }}" method="post" class="form">
    @method('PATCH')
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" value="{{ $user->email }}" required>
    </div>
    <div class="form-group">
        <label for="nameame">Password</label>
        <input type="text" class="form-control" name="password" value="{{ $user->password }}" required>
    </div>
    <button type="submit" class="btn btn-secondary">Update User</button>
</form>

@if ($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach
        </ul>
    </div>
    @endif

 @endsection