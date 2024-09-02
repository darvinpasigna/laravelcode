<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Customers_Model extends Authenticatable
{
   
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "customers";
    protected $fillable = [
        'custom_id', 'fname', 
        'lname', 'contact', 
        'email', 'password', 
        'address', 'city', 
        'province', 'zipcode', 'image'
    ];
  
          /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];
    protected $casts = [
        'password' => 'hashed',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            do {
                $customer->custom_id = mt_rand(100000, 999999);
            } while (self::where('custom_id', $customer->custom_id)->exists());
        });
    }

  
}
