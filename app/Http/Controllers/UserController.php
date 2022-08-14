<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        if(auth()->attempt($credentials)){
            $token = auth()->user()->createToken(auth()->user()->name)->plainTextToken;
            return response()->json([
                'user' => auth()->user(),
                'token' =>   $token,
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(){
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        auth()->attempt($credentials);
        
        auth()->user()->tokens()->delete();
        return response([
            'status' => true,
            'message' => 'Succefully Logged Out !!'
        ]);
    }
}
