@extends('layout')

@section('title','Dashboard')

@section('content')

<div class="row">
        <h1>Admin</h1>
</div>

<ul class="list-group">
        <li class="list-group-item"><a href="/admin/users/"><ion-icon name="people"></ion-icon>Users</a></li>
        <li class="list-group-item"><a href="/admin/posts"><ion-icon name="document"></ion-icon>Posts</a></li>
        <li class="list-group-item"><a href="/admin/categories"><ion-icon name="add"></ion-icon>Categories</a></li>
</ul>

@endsection