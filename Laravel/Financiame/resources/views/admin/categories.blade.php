@extends('layout')


@section('title','Categories')

@section('content')

<div class="row">

    <h1>Categories</h1>
</div>
<div class="row">
    @if(Session::has('notification'))
    <div class="notification is-{{ Session::get('notification') }}">
        {{ Session::get('message') }}
    </div>
    @endif

</div>

<div class="row">
    <a href="#" data-toggle="modal" data-target="#categoryModal">
        <ion-icon name="add-circle-outline"></ion-icon>Create Category
    </a>
</div>
<div class="row">
    <table class="table">
    <thead>
            <tr>
                <th class="col">Id</th>
                <th class="col">Name</th>
                <th class="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach( $categories as $category )
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</a></td> 
                <td>
                <a href="{{ route('admin-delete-category', ['id' => $category->id]) }}"><ion-icon name="trash"></ion-icon></a> 
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<form action="{{action('AdminController@storeCategory')}}" method="POST">
    @csrf
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Create Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <label data-error="wrong" data-success="right" for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control validate" placeholder="Name" required>

                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-deep-orange">
                        <ion-icon name="add-circle-outline"></ion-icon>Add Category
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@if ($errors->any())
<div>
    <ul>
        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach
    </ul>
</div>
@endif
@endsection