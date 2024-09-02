<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    //Reg API (POST)
    public function adminregister(Request $request){
        //Data validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
            ]);

        //Create User
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
            ]);
            return response()->json([
                "status" => true,
                "message"=> "User created successfuly"
                ]);
    }

    //Login API (POST)
    public function adminlogin(Request $request) {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (Auth::guard('web_users')->attempt([
            "email" => $request->email,
            "password" => $request->password
        ])) {
            $user = Auth::guard('web_users')->user(); // Specify the guard

            $token = $user->createToken("myToken")->accessToken;

            return response()->json([
                "status" => true,
                "message" => "User logged in successfully",
                "token" => $token
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Invalid login details"
            ], 401);
        }
    }
    //Profile API (GET)
    public function adminprofile() {
        $user = Auth::user();

        return response()->json([
            "status" => true,
            "message" => "Personal information",
            "data" => $user
        ]);
    }
    //Logout API (GET)
    public function adminlogout() {
        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }
}
