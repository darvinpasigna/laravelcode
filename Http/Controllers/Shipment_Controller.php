<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment_Model;
class Shipment_Controller extends Controller
{
    //
    public function index(){
        $data = Shipment_Model::all();

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
       
        $data = Shipment_Model::create([
             "prod_name" => $request->prod_name,
             "desc" => $request->desc,
             "quantity" => $request->quantity,
             "price" => $request->price,
             "mode_of_payment" =>$request->mode_of_payment, 
             "status" => $request->status,
             "delivery_date" => $request->delivery_date,
             "total_price" => $request->total_price,
             "main_img" =>$request->main_img,

        ]);

        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Failed'
            ]);
        }
    }
}
