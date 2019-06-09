@extends('layout')

@section('title','Posts')

@section('content')

<div class="row">
    <div class="col-2">
        <a href="/posts/create"><ion-icon name="add"></ion-icon>Create Post</a>
    </div>
    <div class="col-10">
        <table class="table">
            <thead>
                <tr>
                    <th>Post Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach($posts as $post)
                <tr>
                    <td><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></td>
                    <td>
                        <a href="{{ route('admin-delete-post',[ 'id'=> $post->id]) }}">
                            <ion-icon name="trash"></ion-icon>
                        </a>
                        <a href="/posts/{{ $post->id }}/edit">
                            <ion-icon name="create"></ion-icon>
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>
    </div>

</div>

@endsection