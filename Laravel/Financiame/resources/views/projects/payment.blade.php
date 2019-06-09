@extends('layout')

@section('title','Reward Packages')

@section('content')

<div class="row">
    <h1> Reward Packages</h1>
</div>
<div class="row">
    <p>To show our gratitude, we would like to offer you different rewards</p>
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
            <form  action="{{ route('sponsor-project') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden"  id="package_id" name="package_id" value="{{$package->packageId }}" >
                        <input type="hidden" id="project_id"  name="project_id" value="{{$project->projectId}}" >
                        <button class="btn btn-primary btn-block" type="submit">Pick Reward</button>
            </form>
        </div>  
    </div>
    @endforeach
</div>
</div>

@endsection

 