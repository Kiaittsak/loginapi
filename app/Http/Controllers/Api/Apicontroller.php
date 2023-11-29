<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class Apicontroller extends Controller
{
    // Register Api (POST)
    public function register(Request $request)
    {
        //Data  validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);
        return response()->json([
            "status" => true,
            "message" => "User Created Successfully"
        ]);
    }
    // Login Api (POST)
    public function login(Request $request)
    {

        $request->validate([
            "email" => "required|email",
            "password" => "required"

        ]);
        if (Auth::attempt([
            "email" => $request->email,
            "password" => $request->password,
        ])) {
            $user = Auth::user();
            $token = $user->createToken("myToken")->accessToken;
            return response()->json([
                "status" => true,
                "message" => "User logged in sccessfully",
                "token" => $token
            ]);
        } else {
            return response()->json([
                "status" => false,

                "message" => "Invalid login details"
            ]);
        }
    }
    // profile Api (POST)
    public function profile(){
        $user = Auth::user();

        return response()->json([
            "status" => true,
            "message" => "Profile information",
            "data" => $user
        ]);
        
    }


    // Logout Api (POST)
    public function logout()
    {
        auth()->user()->token()->revoke();
        return response()->json([
            "status" => true,
            "message" => "User Logged out"
        ]);
    }
}
