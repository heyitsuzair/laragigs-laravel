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
}