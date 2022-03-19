<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; use Hash;

class AuthController extends Controller
{
    
    public function loginShow()
    {
        //
        return view('auth.login');
    }

    public function regShow()
    {
        //
        return view('auth.register');
    }


    public function login(Request $request)
    {
        //
        if(!auth()->attempt($request->only('email','password'))){
            return back()->with('error','invalid login details');
        }

        return redirect()->route('/');
    }

    public function register(Request $request)
    {
        //

        $this->validate($request,
			[	'username' => 'required|max:255',
				'email' => 'required | string | unique:users,email',
				'password' => 'required|confirmed'
			]
		);
		User::create(['name'=>$request->username,'email'=>$request->email,'role_id'=>2,'password' => Hash::make($request->password)]);

        return redirect()->route('login')->with('status','Registered successfully');
    }

    public function logout()
    {
        //
        auth()->logout();
        return redirect()->route('login');
    }
}
