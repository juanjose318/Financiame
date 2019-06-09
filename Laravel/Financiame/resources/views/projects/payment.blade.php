@extends('layout')

@section('title','Reward Packages')

@section('content')

<div class="row">
    <h1> Reward Packages</h1>
</div>
<div class="row">
    <p>To show our gratitude, we would live to offer you different rewards</p>
</div>
<div class="row">
<div class="card-deck mb-3 text-center">
    @foreach ($project->packages as $package)

    <div class="card  mb-4 box-shadow">
        <div class="card-header">
            <h2 class="card-title">{{ $package->title }}</h2>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $package->description }}</p>
        </div>
        <div class="card-footer">
            <b class="mt-3 mb-4" >{{ $package->credit_price }} credits </b>
            <a class="btn btn-primary btn-lg btn-block" href="#">Pick Reward</a>
           
        </div>
    </div>
    @endforeach
</div>
</div>

@endsection

 