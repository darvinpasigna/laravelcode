<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_Model;

class Product_Controller extends Controller
{
    //
    public function index(){
        $data = Product_Model::all();

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

    public function store(Request $request)
    {
       
        $data = Product_Model::create([
            "prod_category" => $request->prod_category,
            "prod_name" => $request->prod_name,
            "price" => $request->price,
            "desc" => $request->desc,
            "stock" => $request->stock,
            "main_img" => $request->main_img,
            "img1" => $request->img1,
            "img2" => $request->img2,
            "img3" => $request->img3,
        ]);

        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Product uploaded successfully',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Failed to upload'
            ]);
        }
    }

    public function edit(Request $request, int $id){
        $data = Product_Model::find($id);

        if($data){
            $data->update([
                "prod_category" => $request->prod_category,
                "prod_name" => $request->prod_name,
                "price" => $request->price,
                "desc" => $request->desc,
                "stock" => $request->stock,
                "main_img" => $request->main_img,
                "img1" => $request->img1,
                "img2" => $request->img2,
                "img3" => $request->img3,
                ]);



            return response()->json([
                'status' => 200,
                'data' => 'updated successfully'
                ]);
        }else {
            return response()->json([
            'status' => 404,
            'data' => "failed!"
                ]);
        }
      
        
    }

}
