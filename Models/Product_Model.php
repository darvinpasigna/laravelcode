<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Model extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
       "prod_category",
       "prod_name","price",
       "desc", "stock",
       "main_img","img1",
       "img2", "img3"
        ];
}
