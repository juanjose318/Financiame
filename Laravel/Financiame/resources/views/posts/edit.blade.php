@extends('layout')

@section('title')

Edit Post

@endsection

@section('content')

<h1>Edit Post</h1>

<form method="POST" action="/posts/{{ $post->id }}">
    @method('PATCH')
    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" value="{{ $post->title }} required">
    </div>
    <div class="form-group">
        <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3" required>{{ $post->content }}</textarea>
    </div>

    <button class="btn btn-secondary" type="submit">Update Post</button>

</form>


<form method="POST" action="/posts/{{ $post->id }}">
    @method('DELETE')
    @csrf
  
        <button type="submit" class="btn btn-secondary"> Delete Post </button>
   
</form>


@endsection