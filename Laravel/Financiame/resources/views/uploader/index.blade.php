@extends('layout')

@section('content')

<div class="container">
   <div class="columns is-desktop">
       <div class="column">
           <h1 class="title">Image Upload</h1>
       </div>
   </div>

   <!-- Notification laten zien -->

   <!-- @todo: vervangen door een Noty notification :slightly_smiling_face: -->
   @if(Session::has('notification'))
       <div class="notification is-{{ Session::get('notification') }}">
           {{ Session::get('message') }}
       </div>
   @endif

   <div class="columns is-desktop">
       <div class="column">
           <form action="{{route('postUpload')}}" method="post" enctype="multipart/form-data">
               @csrf

               <div class="field">
                   <div class="control">
                       <input type="text" name="project_id" placeholder="Project ID">
                   </div>
               </div>

               <table class="table is-srtiped">
                   <tbody>
                       <tr>
                           <td>
                               <input type="file" name="file[]" if="file">
                           </td>
                           <td>
                               <div class="control">
                                   <button class="button is-success">
                                       <i class="fas fa-plus"></i>
                                   </button>
                               </div>
                           </td>
                       </tr>
                   </tbody>
               </table>

               <div class="control">
                   <button type="submit" class="button is-primary">
                       Verzenden
                   </button>
               </div>
           </form>

           @if(count($errors) > 0)
               <div class="notification is-danger">
                   <strong>Ola,</strong> er ging iets mis!

                   <ul>
                       @foreach($errors as $error)
                           <li>{{ $error }}</li>
                       @endforeach
                   </ul>
               </div>
           @endif
       </div>
   </div>
</div>

@endsection
Message Input

Message #coding