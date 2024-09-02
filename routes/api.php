<?php

use App\Http\Controllers\Customers_Controller;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\Cart_Controller;
use App\Http\Controllers\Order_Controller;
use App\Http\Controllers\Shipment_Controller;
use App\Http\Controllers\api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user();
//});

//Open Routes
Route::post("register", [Customers_Controller::class,"register"]);
Route::post("login", [Customers_Controller::class,"login"]);

//Protected Routes
Route::group([
    "middleware" => ["auth:api"]
    ], function(){
        Route::get("profile", [Customers_Controller::class, "profile"]);
        Route::get("logout", [Customers_Controller::class, "logout"]);
    });

Route::post("adminregister", [ApiController::class,"adminregister"]);
Route::post("adminlogin", [ApiController::class,"adminlogin"]);

//Protected Routes
Route::group([
    "middleware" => ["auth:api"]
    ], function(){
        Route::get("adminprofile", [ApiController::class, "adminprofile"]);
        Route::get("adminlogout", [ApiController::class, "adminlogout"]);
    });

Route::get('customers', [Customers_Controller::class, 'index']);
Route::delete('customers/delete/{custom_id}', [Customers_Controller::class, 'destroy']);
Route::put('customers/edit/{custom_id}', [Customers_Controller::class,'edit']);

Route::get('products', [Product_Controller::class, 'index']);
Route::post('products/addprod', [Product_Controller::class, 'store']);
Route::post('products/edit/{id}', [Product_Controller::class,'edit']);

Route::get('cart', [Cart_Controller::class, 'index']);
Route::post('cart/addtocart', [Cart_Controller::class, 'store']);
Route::delete('cart/delete/{id}',[Cart_Controller::class, 'destroy']);

Route::get('order', [Order_Controller::class, 'index']);
Route::post('order/addorder', [Order_Controller::class, 'store']);
Route::delete('order/delete/{id}', [Order_Controller::class, 'destroy']);

Route::get('ship', [Shipment_Controller::class, 'index']);
Route::post('ship/send', [Shipment_Controller::class, 'store']);
