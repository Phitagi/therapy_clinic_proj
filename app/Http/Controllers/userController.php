<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; use App\Models\Roles; use Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users= User::is_admin() ? $users=User::paginate(10) : User::where('id',auth()->user()->id)->paginate(10); 

        return view('users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        //
        $roles=Roles::get();
        return view('users.edit',['user'=>$user,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $this->validate($request,
            [	'name' => 'required|max:255',
                'email' => 'required | string',
                //'password' => 'required|confirmed'
            ] 
        );

        $emailExists=User::where('email','!=',$user->email)->where('email',$request->email)->exists();
        if($emailExists){
            return back()->with('error','Email exists');
        }

        $role_id=isset($request->role) ? $request->role : $user->role_id ;

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'role_id'=>$role_id,
        ]);

        if(!empty($request->password)){
            $user->update([ 'password' => Hash::make($request->password) ]);
        }

        return back()->with('status','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete',$user);

        $user->delete();

        return back()->with('status','Deleted successfully');
    }
}
