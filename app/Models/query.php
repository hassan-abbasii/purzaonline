<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class query extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->belongsTo(productGeneral::class, 'prod_id');
    }
    public function car()
    {
        return $this->belongsTo(carDetail::class, 'car_id');
    }
    public function shop()
    {
        return $this->belongsTo(shop::class, 'shop_id');
    }
    public function users()
    {
        return $this->belongsTo(users::class, 'user_id');
    }

}
