<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
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
}
