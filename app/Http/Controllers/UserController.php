<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show Create Form
    public function create(Request $request)
    {
        return view('users.register');
    }
    // Show Create Form
    public function store(Request $request)
    {
        $formFields =  $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);
        // Create a new user
        $user = User::create($formFields);

        // Login User
        auth()->login($user);

        return redirect('/')->with('message', 'User Created And Logged In');
    }
    // Logout User
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/')->with('message', 'User Has Been Logged Out');
    }
    // Login Form 
    public function login(Request $request)
    {
        return view('users.login');
    }

    // Login User
    public function postLogin(Request $request)
    {
        // Validate Email Address And Password
        $formFields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You Are Logged In');
        }

        return redirect('/login')->with('message', 'Invalid Credentials!');
    }
}