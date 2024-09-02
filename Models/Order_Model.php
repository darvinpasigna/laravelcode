<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Model extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        "prod_name", "desc", "quantity",
        "price_per_item", "total_price",
        "mode_of_payment", "main_img"
        ];
}
