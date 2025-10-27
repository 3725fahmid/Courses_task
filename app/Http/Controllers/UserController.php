<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $users = User::with('roles')->latest()->get();
            return view('backend.modules.user.index',compact('users'));

        }catch (Exception $ex){

            abort('403');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()??'';
        return view('backend.modules.user.create',compact('roles'));
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'username'      =>  'required|unique:users',
            'user_email'     =>  'required|unique:users',
            'role_id'   =>  'required|array',
            'role_id.*' =>  'integer',
            'password'      =>  'required|unique:users',

        ]);

        $user = new User();
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_email = $request->user_email;
        $user->user_mobile = $request->user_mobile;
        $user->user_type = $request->user_type;
        $user->user_status = $request->user_status;

        if ($request->file('user_image')) {
            $file = $request->file('user_image');

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $user['user_image'] = $filename;

        }

        $user->password = Hash::make($request->password);
        $user->assignRole($request->input('role_id'));
        $user->save();

        $notification = array(
            'message' => 'User created Successfully',
            'alert-type' => 'info'
        );

        return redirect('users')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('backend.modules.user.show',compact('user'));
    }

   // edit
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('backend.modules.user.edit',compact('user','roles'));
    }

    //update
    public function update(Request $request, User $user)
    {

        $request->validate([
            'username'      =>  'required|unique:users,username, '.$user->id,
            'user_email'     =>  'required|unique:users,user_email, '.$user->id,
            'role_id'   =>  'required|array',
            'role_id.*' =>  'integer',

        ]);

        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_email = $request->user_email;
        $user->user_mobile = $request->user_mobile;
        $user->user_type = $request->user_type;
        $user->user_status = $request->user_status;

        if ($request->file('user_image')) {

            $file = $request->file('user_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            unlink(public_path('upload/admin_images/'.$user->user_image));
            $file->move(public_path('upload/admin_images'),$filename);
            $user->user_image = $filename;

        }else{

            unset($user->user_image);

        }

        $user->password = Hash::make($request->password);
        $user->syncRoles($request->input('role_id'));
        $user->update();

        $notification = array(
            'message' => 'User update Successfully',
            'alert-type' => 'info'
        );

        return redirect('users')->with($notification);

    }

    // destroy
    public function destroy(User $user)
    {

        $img = $user->user_image;
        unlink('upload/admin_images/'.$img);

        if(isset($user)){
            $user->delete();
            return redirect('users')->with(['message'=>'Data deleted successfully !!.','alert-type'=>'info']);
        }else{
            abort('403');
        }
    }
}
