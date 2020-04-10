@extends('layouts.admin')


@section('content')


@include('includes.form_errors')

<h1>Create Post</h1>
 


{!!Form::open(['method'=>'POST' , 'action'=>'AdminPostsController@store' , 'files'=>true]) !!}

  <div class="form-group">
  	     {!!Form::label('title', 'Title') !!}
  	     {!!Form::text('title',null,['class'=>'form-control'])!!}

  </div>


  <div class="form-group">
  	    {!!Form::label('category_id','Category')!!}
  	    {!!Form::select('category_id',[''=>'Select Options'] + $categories ,null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  	   {!!Form::label('photo_id','Upload Photo')!!}
  	   {!!Form::file('photo_id',null,['class'=>'form-control'])!!}
  </div>


  <div class="form-group">
  	    {!!Form::label('body','Description')!!}
  	    {!!Form::textarea('body',null,['class'=>'form-control', 'rows'=>'7'])!!}
  </div>

  <div class="form-group">
  	  {!!Form::submit('Create Post',['class'=>'btn btn-success'])!!}
  </div> 

{!! Form::close() !!} 

@endsection