<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_Model extends Model
{
    use HasFactory;
    protected $table = "cart_items";
    protected $fillable = [
        "prod_name", 
        "desc",
        "price_per_item",
        "main_img"
        ];
}
