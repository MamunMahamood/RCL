<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Volunteer;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function auth_register(Request $request){

        

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
           
        ]);


        Volunteer::create([
            'user_id'=> $user->id,
        ]);

        // Redirect back with success message
        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');

    }

    public function login(){
        if(Auth::check() && Auth::user()->is_Admin == 1){

            return redirect()->route('admin.dashboard');

        }
        
        return view('auth.login');
    }

    public function auth_login(Request $request){
        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password], $remember)){
            return redirect()->route('volunteer.dashboard');
        }
        else{
            return redirect()->back()->with('error', 'Invalid Email or Password');
        }
        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
