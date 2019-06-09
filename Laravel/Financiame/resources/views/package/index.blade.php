@extends('layout')

@section('title','Reward Packages')

@section('content')

<div class="row">
    <h1> Reward Packages</h1>
</div>
<div class="row">
    <p>Motivate other people to support your project.</p>
</div>
<div class="row">
<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($packages as $package)
        <tr>
            <td>{{ $package->title }}</td>
            <td>{{ $package->description }}</td>
            <td>{{ $package->credit_price }}</td>
            <td>
                <a href="{{ route('packages-delete', ['id' => $package->id]) }}">
                    <ion-icon name="trash"></ion-icon>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<div class="row">
<div class="col-6">
<p>You're almost done, create rewards for your funders so they can get <b>extra benefits</b> from your project...</p>
</div>
<div class="col-6">
<a href="/packages/create" class="btn btn-primary">Create Package</a>
</div>
</div>

@endsection