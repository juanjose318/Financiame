@extends('layout')

@section('content')

<div class="row">
    <div class="col-sm-8">
    <h1 class="title"> {{ $project->title }} </h1>
        <p> {{ $project->content }} </p>

        @foreach($images as $image )
        <img class="projectPic" src="{{ asset('storage/' . $image) }}" alt="">
        @endforeach
        <div>
            @if ($project->userId == Auth::id())
            <a href="{{ route('packages-show', ['project' => $project->id]) }}" class="btn btn-primary disabled">Support this project</a>
            @elseif(null != Auth::check())
            <a href="{{ route('packages-show', ['project' => $project->id]) }}" class="btn btn-primary">Support this project</a>
            @elseif (null != Auth::check())
            <a href="{{ route('packages-show', ['project' => $project->id]) }}" class="btn btn-primary disabled">Support this project</a>
            @endif
        </div>
    </div>

    <div class="col-sm-4">
        <h3>Credits to achieve</h3>
        <b>{{ $project->credit_goal }}</b>
        <p>This project will end on {{ $project->final_time }}</p>

    

        @if(auth()->id()==$project->user_id)

        <h3><a class="title" href="/packages">Packages</a></h3>

        @else

        <h3>Packages</h3>

        @endif

        @foreach( $packages as $package)

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">{{ $package->title }}</h2>
            </div>
            <div class="card-body">

                <p class="card-text">{{ $package->description }}</p>
                <b>{{ $package->credit_price }} credits </b>
            </div>
        </div>

        @endforeach
    </div>
</div>

@endsection