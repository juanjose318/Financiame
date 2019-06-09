@extends('layout')

@section('title','Create Post')

@section('content')

<h1>Create a New Post</h1>

<form method="POST" action="{{ action('PostController@store') }} " enctype="multipart/form-data">
   @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" required value="{{ old('title')}}">
    </div>
    <div class="form-group">
        <label for="intro">Intro</label>
        <input type="text" class="form-control" name="intro" required value="{{ old('title')}}">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content" required>{{ old('content')}}</textarea>
    </div>
    <div class="form-group">
        <label for="image">Add an image</label>
        <input type="file" name="image" class="form-control-file">

    </div>
    <button type="submit" class="btn btn-primary">Create Article</button>

   
</form>

@endsection