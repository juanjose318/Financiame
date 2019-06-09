@extends('layout')

@section('title','Edit Post')

@section('content')

<h1>Edit Project </h1>

<form method="POST" action="/projects/{{ $project->id }}">
   @method('PATCH')
   @csrf

    
   <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" required value="{{ $project->title}}">
    </div>

    <div class="form-group">
        <label for="intro">Intro</label>
        <input type="text" class="form-control" name="intro" required value="{{ $project->intro }}">
    </div>

      <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" id="exampleFormControlTextarea1" required>{{$project->content}}</textarea>
    </div>

    <div class="form-group">
        <label for="credit_goal">Credits to achieve</label>
        <input type="integer" class="form-control" name="credit_goal" required value="{{ $project->credit_goal}}">
    </div>
    <div class="form-group">
        <label for="final_time">Final date of your funding</label>
        <input type="date" class="form-control" name="final_time" value="{{$project->final_date}}">
    </div>
    <div class="form-group">
        <label for="sel1">Select list:</label>
        <select class="form-control" id="sel1" name="category_id">
            @foreach($categories as $category)
            <option value="{{ $category->id }}"> {{ $category->name }} </option> 
            @endforeach
        </select>
    </div>
    
  
<button class="btn btn-primary" type="submit">Update</button>
</form>
<form method="POST" action="/projects/{{ $project->id }}">
@method('DELETE')
@csrf 

<button class="btn btn-primary"type="submit"> Delete Project </button>
</form>
@endsection