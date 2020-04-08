@extends('layouts.admin')


@section('content')

@include('includes.message')
  
  <h1>Users</h1>

  <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Photo</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th>Created_at</th>
          <th>Updated_at</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

      	@foreach($users as $user)

           <tr>
             <td>{{$user->id}}</td>
             <td><img src="{{$user->photo ? $user->photo->file : 'No Photo'}}" alt="{{$user->photo ? $user->photo->file : 'No Photo'}}" height="50"></td>
             <td>{{$user->name}}</td>
             <td>{{$user->email}}</td>
             <td>{{$user->role->name}}</td>
             <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
             <td>{{$user->created_at->diffForHumans()}}</td>
             <td>{{$user->updated_at->diffForHumans()}}</td>
             <td><a class="btn btn-primary btn-xs" href="{{route('admin.users.edit',$user->id)}}">Edit</a></td>
             <td>
              {!!Form::model($user , ['method'=>'DELETE' , 'action'=>['AdminUsersController@destroy',$user->id] , 'files'=>true]) !!}

                
                {!!Form::submit('Delete',['class'=>'btn btn-danger btn-xs'])!!}
                  

              {!! Form::close() !!} 

            </td>
             
           </tr>

      	@endforeach
        
      </tbody>
    </table>
@endsection