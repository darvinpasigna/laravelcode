<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_Model;

class Order_Controller extends Controller
{
    //
    public function index(){
        $data = Order_Model::all();

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
       
        $data = Order_Model::create([
            "prod_name" => $request->prod_name,
            "desc" => $request->desc,
            "quantity" => $request->quantity,
            "price_per_item" => $request->price_per_item,
            "total_price"=> $request->total_price,
            "mode_of_payment"=> $request->mode_of_payment,
            "main_img" => $request->main_img
            
        ]);

        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Success!',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Failed to order!'
            ]);
        }
    }

    public function destroy($id){
        $Data_fr_db = Order_Model::find($id);
        
        if($Data_fr_db){
            $Data_fr_db->delete();
            return response()->json([
                'status' => 200,
                'message'=> 'Deleted successfully'
                ]);
        }else{
            return response()->json([
                'status' => 404,
                'message'=> 'Error'
                ]);
        }
    }

}
