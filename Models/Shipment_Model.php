<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment_Model extends Model
{
    use HasFactory;
    protected $table = "shipment_tbl";
    protected $fillable = [
        "prod_name", "desc", 
        "quantity","mode_of_payment",
        "status","delivery_date", 
        "main_img", "price", "total_price"
        ];
}
