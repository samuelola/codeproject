@if(Session::has('user_deleted'))
   
   <div class="alert alert-danger">
       {{Session('user_deleted')}}
   </div> 

@endif

@if(Session::has('create_user'))
   
   <div class="alert alert-success">
       {{Session('create_user')}}
   </div> 

@endif

@if(Session::has('update_user'))
   
   <div class="alert alert-success">
       {{Session('update_user')}}
   </div> 

@endif


@if(Session::has('the_post'))

  <div class="alert alert-success">
  	 
  	 {{Session('the_post')}}

  </div>

@endif