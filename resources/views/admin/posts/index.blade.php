@extends('layouts.admin')


@section('content')

<h1>Post</h1>


<table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>User</th>
        <th>Category</th>
        <th>Title</th>
        <th>Body</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>

     @if($posts)
     
        @foreach($posts as $post)
            
           <tr>
             <td>{{$post->id}}</td>
             <td><img src="{{$post->photo->file ? $post->photo->file : 'No Image'}}" alt="No Image" height="50"></td>
             <td>{{$post->user->name}}</td>
             <td>{{$post->category_id}}</td>
             <td>{{$post->title}}</td>
             <td>{{$post->body}}</td>
             <td>{{$post->created_at->diffForHumans()}}</td>
             <td>{{$post->updated_at->diffForHumans()}}</td>
           </tr> 

        @endforeach

     @endif 	
      
     
    </tbody>
  </table>





<!-- <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
     
    </tbody>
  </table> -->




@endsection