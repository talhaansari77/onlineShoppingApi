<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
 


class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function register()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);

        $token = $user->createToken($user->name)->plainTextToken;
        // sending verification link
        // event(new Registered($user));

        return response()->json([
            'user'=> $user,
            'token' => $token,
        ]);
        
    }

    public function authenticate()
    {
        // dd(request()->all());
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = auth()->attempt($credentials) ;
        if($user){
            // $token = auth()->user()->createToken(auth()->user()->name)->plainTextToken;

            return response()->json([
                'user' => $user,
                'status' => true,
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        // $credentials = request()->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);
        // auth()->attempt($credentials);
        
        // auth()->user()->tokens()->delete();
        return response([
            'status' => true,
            'message' => 'Succefully Logged Out !!'
        ]);
    }
}
