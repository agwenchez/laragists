<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //  index
    public function index(){

    }

    // show register/create form
    public function create(Request $request){
        return view('users.register');
    }
    // Store User data
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required','email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash your password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create user
        $user = User::create($formFields);

        // Login the user
        Auth::login($user);

        return redirect('/')->with('message','User logged in succesfully');
    }

    // Log user out and invalidate session
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message','You have been logged out!');
    }

    // show login form
    public function login(Request $request){
        return view('users.login');
    }

    // Authenticate user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        
        if(Auth::attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','You are now logged in');
        }
        return back()->withErrors(['email'=> 'Invalid credentials!'])->onlyInput('email');
    }

}
