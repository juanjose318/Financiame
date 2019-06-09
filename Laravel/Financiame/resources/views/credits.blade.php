@extends('layout')

@section('title','Buy credits')

@section('content')


    <h1 class="title">Buy Credits</h1>

    <form action="{{ action('PaymentController@store') }}" class="form" method="POST">
        @csrf 
        <div class="form-group">
            <label for="card">Credit card number</label>
            <input type="text" placeholder="4111 1111 1111 1111" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="name">Name on the card</label>
            <input type="text" placeholder="Jon Doe" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="credits">Amount of credits you wish to buy</label>
            <input type="text" name="credits" placeholder="Credits" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add credits</button>
    </form>


@endsection