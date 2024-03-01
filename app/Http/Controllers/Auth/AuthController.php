<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        $pageTitle = 'Potter Create::Login';
        return view('pages.auth.login', compact('pageTitle'));
    }

    public function processLogin(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->with(['message'=>'Hello '.\auth()->user()->name.', Welcome back']);
        }

        return redirect("login")->withErrors('Login details are not valid');
    }

    public function listUsers()
    {
        $users = User::all();
        return view('pages.auth.users', compact('users'));
    }

    public function registration()
    {
        
        return view('pages.auth.create-user');
    }

    public function processRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->with(['message'=>'New User Successfully added']);
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login')->with(['message'=>'You\'re logged out now. Good to take some rest']);
    }
}
