@extends('layout')

@section('title','Create Package')

@section('content')
<h1>Create New Package</h1>

<form method="POST" action="{{ route('packages-store') }}">
    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" name="description" required>
    </div>
    <div class="form-group">
        <label for="credit_price">Price</label>
        <input type="number" class="form-control" name="credit_price" required>
    </div>
    <div class="form-group">
        <label for="project_id">Choose your project</label>
        <select name="project_id" class="form-control">
            @foreach ($projects as $project)
            <option value="{{ $project->projectId }}">{{ $project->title }}</option>
            @endforeach
        </select>
    </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Package</button>
        </div>

    </div>
</form>

@endsection