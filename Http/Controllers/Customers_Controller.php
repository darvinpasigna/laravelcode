<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers_Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Customers_Controller extends Controller
{
    //
    public function index()
    {
        $data = Customers_Model::all();

        if($data->count() > 0){
            return response()->json([
                'status' => 200,
                'data' => $data
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'data' => "Not Found!"
            ]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            "fname" => "required",
            "lname" => "required",
            "contact" => "required",
            "email" => "required|email|unique:customers",
            "address" => "required",
            "city" => "required",
            "province" => "required",
            "zipcode" => "required",
            "password" => "required|confirmed"
            ]); 

        $data = Customers_Model::create([
            "fname" => $request->fname,
            "lname" => $request->lname,
            "contact" => $request->contact,
            "email" => $request->email,
            "address" => $request->address,
            "city" => $request->city,
            "province" => $request->province,
            "zipcode" => $request->zipcode,
            "password" => Hash::make($request->password), 
            "image" => $request->image
        ]);
        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Account created successfully',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Failed to create account'
            ]);
        }
    }

     //Login API (POST)
     public function login(Request $request){
        //Data validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
            ]);
        
        //checking user login
       if ( Auth::guard('web')->attempt([
            "email" => $request->email,
            "password" => $request->password
            ])){
                //user exists
                $user = Auth::user();

                $token = $user->createToken("myToken")->accessToken;

                return response()->json([
                    "status" => true,
                    "message"=> "User logged in successfully",
                    "token" => $token
                    ]);
            }else{
                return response()->json([
                    "status" => false,
                    "message"=> "Invalid login detail"
                    ]);
            }
    }

       //Profile API (GET)
       public function profile(){

        $user = Auth::user();

        return response()->json([
            "status" => true,
            "message" => "Personal information",
            "data" => $user
            ]);

        }

        public function logout(){

        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message"=> "User Logged out"
            ]);
        }
    public function destroy($custom_id) {
    $customer = Customers_Model::where('custom_id', $custom_id)->first();
    
    if ($customer) {
        $customer->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Deleted successfully'
        ]);
    } else {
        return response()->json([
            'status' => 404,
            'message' => 'Customer not found'
        ]);
    }
}

public function edit(Request $request, int $custom_id) {
    // Find the customer by custom_id
    $data = Customers_Model::where('custom_id', $custom_id)->first();

    if ($data) {
        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = 'images/' . $filename; // Store path relative to public folder
            $file->move(public_path('images'), $filename); // Move file to the public folder
            $data->image = $filePath;
        }

        // Prepare data to update
        $data->update([
            "image" => $data->image // Update image if it's set
        ]);

        return response()->json([
                'status' => true,
                'data' => $data
                ]);
        }else {
            return response()->json([
            'status' => 404,
            'data' => "failed!"
                ]);
        }
}
}