<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;


class AdminUsersController extends Controller
{
    
    public function __construct(){

        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        $roles = Role::lists('name','id')->all();

        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {    
        

         $input = $request->all();


         $input['password'] = bcrypt($request->password);


         if($sam = $request->file('photo_id')){
           
             $photo_name = time().$sam->getClientOriginalName();

             $sam->move('images',$photo_name);

             $photo = Photo::create(['file'=>$photo_name]);

             $input['photo_id'] = $photo->id;
         }

    
         User::create($input);


         Session::flash('create_user','User has beeen created!');

         return redirect()->route('admin.users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::lists('name','id')->all(); 
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);


        $input = $request->all();

        if($request->password == ''){

          $input = $request->except('password'); 
        }
        else{

            $input['password'] = bcrypt($request->password);
        }


        if($file = $request->file('photo_id')){
          
           $name = time().$file->getClientOriginalName();
           $file->move('images',$name);

           $photosam = Photo::create(['file'=>$name]);


           $input['photo_id'] = $photosam->id;
        }


        

        $user->update($input);

        Session::flash('update_user','User has been updated!');

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $user = User::findOrFail($id);

         unlink(public_path() . $user->photo->file);

        // unlink(public_path() ."/images/".$user->photo->file);


         Photo::where('id',$user->photo_id)->delete();

         $user->delete();

         Session::flash('user_deleted', 'The user has been deleted!');

         return redirect()->route('admin.users.index');
    }
}
