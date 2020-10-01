<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 use Auth;
 use Route;
 use Session;

class AdminLoginController extends Controller
 {

public function __construct()
 {
 $this->middleware('guest:admin', ['except' => ['logout']]);
 }



public function login(Request $request)
 {
     
 // Validate the form data
 $this->validate($request, [
 'email' => 'required|email',
 'password' => 'required|min:6'
 ]);

// Attempt to log the user in
 if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
 // if successful, then redirect to their intended location
 return redirect()->route('welcome');
 }
 // if unsuccessful, then redirect back to the login with the form data
 return redirect()->back()->withErrors(['msg', 'You have already Saved this Category']);
 }


public function logout()
 {
 Auth::guard('admin')->logout();
 Session::flush();
 return redirect()->route('home');
 }
 }