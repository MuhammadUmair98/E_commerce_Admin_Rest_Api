<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use DB;
use Validator;
class AuthController extends Controller
{
    public function signup(Request $request)
    {
        
    /*    $mystring =	$request;
        //$mystring =	$request->users;
        //$mystring = json_decode($mystring);
            
        $validator=Validator::make($request, [
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|confirmed'
            ]);
            
            if ($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
            }
            
        /*    $this->validate($request->orders,[
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|confirmed'
            ]);
            
            $user =User::create([
                'name' => $mystring['name'],
                'email' => $mystring['email'],
                'password' => bcrypt($mystring['password']),
                'Location' => $mystring['location'],
                'lat'=>$mystring['lat'],
                'long'=>$mystring['long'],
                'contact'=>$mystring['contact']
            ]);
            $user->save();
            $credentials = (['email'=>$mystring['email'], 'password'=>$mystring['password']]);
            if(!Auth::attempt($credentials))
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ], 201);
        }*/
        $validator=Validator::make($request->toArray(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        
        if ($validator->fails()){
        return response()->json(['errors'=>$validator->errors()]);
        }
        $user =User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'Location' => $request->location,
            'lat'=>$request->lat,
            'long'=>$request->long,
            'contact'=>$request->contact
        ]);
        $user->save();
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
             'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ], 201);
    }
    
    public function login(Request $request)
    {
        $validator=Validator::make($request->toArray(),[
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        if ($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
            }
     /*   $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        */
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $data=DB::table('users')->where('email',$request->email)->get();
        
if(isset($data)){
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'data'=>$data[0],  
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
            }
            else{
                return response()->json([
                   'message'=>"Credentials not Correct!" 
                ]);
            }
    }
    public function logout(Request $request)
    {
        return $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

}
