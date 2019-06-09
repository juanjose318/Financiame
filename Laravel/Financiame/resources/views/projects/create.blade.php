@extends('layout')

@section('title')
Create Project
@endsection


@section('content')

<h1>Create a New Project</h1>

<form method="POST" action="{{ action('ProjectController@store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" required value="{{ old('title')}}">
    </div>

    <div class="form-group">
        <label for="intro">Intro</label>
        <input type="text" class="form-control" name="intro" required value="{{ old('intro')}}">
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" id="exampleFormControlTextarea1" required>{{ old('content')}}</textarea>
    </div>

    <div class="form-group">
        <label for="credit_goal">Credits to achieve</label>
        <input type="integer" class="form-control" name="credit_goal" required value="0">
    </div>
    <div class="form-group">
        <label for="final_time">Final date of your funding</label>
        <input type="date" class="form-control" name="final_time">
    </div>
    <div class="form-group">
        <label for="sel1">Select list:</label>
        <select class="form-control" id="sel1" name="category_id">
            @foreach($categories as $category)
            <option value="{{ $category->id }}"> {{ $category->name }} </option> 
            @endforeach
        </select>
    </div>
    <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
  </div>
  <div class="custom-file">
    <input type="file" name="image[]" class="custom-file-input" id="inputGroupFile01"aria-describedby="inputGroupFileAddon01" multiple>
    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
  </div>
</div>

    <button type="submit" class="btn btn-primary">Create Project</button>

    @if ($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach
        </ul>
    </div>
    @endif
</form>

@endsection